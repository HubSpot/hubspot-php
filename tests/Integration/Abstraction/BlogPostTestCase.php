<?php

namespace SevenShores\Hubspot\Tests\Integration\Abstraction;

use DateTime;
use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\BlogAuthors;
use SevenShores\Hubspot\Resources\BlogPosts;
use SevenShores\Hubspot\Resources\Blogs;

abstract class BlogPostTestCase extends EntityTestCase
{
    protected $blogId;

    protected $authorId;

    public function setUp()
    {
        $blogs = new Blogs(new Client(['key' => getenv($this->key)]));
        $this->blogId = $blogs->all(['limit' => 1])->objects[0]->id;

        $blogAuthor = new BlogAuthors(new Client(['key' => getenv($this->key)]));
        $this->authorId = $blogAuthor->all(['limit' => 1])->objects[0]->id;

        parent::setUp();
    }

    protected function createPost(BlogPosts $resource)
    {
        $date = new DateTime();

        return $resource->create([
            'name' => 'My Super Awesome Post '.uniqid(),
            'content_group_id' => $this->blogId,
            'publish_date' => $date->getTimestamp(),
            'blog_author_id' => $this->authorId,
            'meta_description' => 'My Super Awesome Post ...',
            'slug' => '/blog/'.uniqid().'/my-first-api-blog-post',
        ]);
    }
}
