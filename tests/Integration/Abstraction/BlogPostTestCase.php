<?php

namespace SevenShores\Hubspot\Tests\Integration\Abstraction;

use DateTime;
use SevenShores\Hubspot\Endpoints\BlogAuthors;
use SevenShores\Hubspot\Endpoints\BlogPosts;
use SevenShores\Hubspot\Endpoints\Blogs;
use SevenShores\Hubspot\Http\Client;

abstract class BlogPostTestCase extends EntityTestCase
{
    protected $blogId;

    protected $authorId;

    public function setUp(): void
    {
        $blogs = new Blogs(new Client(['key' => getenv($this->key)]));
        $this->blogId = $blogs->all(['limit' => 1])->objects[0]->id;

        $blogAuthor = new BlogAuthors(new Client(['key' => getenv($this->key)]));
        $this->authorId = $blogAuthor->all(['limit' => 1])->objects[0]->id;

        parent::setUp();
    }

    protected function createPost(BlogPosts $endpoint)
    {
        $date = new DateTime();

        return $endpoint->create([
            'name' => 'My Super Awesome Post '.uniqid(),
            'content_group_id' => $this->blogId,
            'publish_date' => $date->getTimestamp(),
            'blog_author_id' => $this->authorId,
            'meta_description' => 'My Super Awesome Post ...',
            'slug' => '/blog/'.uniqid().'/my-first-api-blog-post',
        ]);
    }
}
