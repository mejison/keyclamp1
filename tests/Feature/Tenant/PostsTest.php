<?php

namespace Tests\Feature\Tenant;

use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TenantTestCase;
use Tests\TestCase;

class PostsTest extends TenantTestCase
{
    protected $shouldSeed = false;

    /** @test */
    public function posts_can_be_created()
    {
        $this->post('/posts', [
            'title' => 'Foo',
            'body' => 'Bar',
        ]);

        $this->assertSame('Foo', Post::first()->title);
        $this->assertSame('Bar', Post::first()->body);
    }

    /** @test */
    public function posts_appear_on_the_post_index()
    {
        auth()->user()->posts()->create([
            'title' => 'Foo post',
            'body' => 'Bar',
        ]);

        $this->get('/posts')
            ->assertSee('Foo post');
    }

    /** @test */
    public function each_post_has_a_detail_page()
    {
        $this->post('/posts', [
            'title' => 'Foo post',
            'body' => 'Bar',
        ]);

        $this->get('/posts/1')
            ->assertSee('Foo post');
    }
}
