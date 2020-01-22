<?php

namespace SevenShores\Hubspot\Tests\Integration\Abstraction;

use SevenShores\Hubspot\Resources\Blogs;
use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\BlogAuthors;

abstract class BlogPostTestCase extends DefaultTestCase
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
}
