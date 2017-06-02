<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function setup()
    {
        parent::setup();

        $this->thread = create('App\Thread');
    }

    /** @test */
    public function a_user_can_view_all_threads()
    {
        $this->get($this->thread->path())->assertSee($this->thread->title);
    }

     /** @test */
    public function a_user_can_view_a_single_thread()
    {
        $this->get($this->thread->path())->assertSee($this->thread->title);
    }

     /** @test */
    public function a_user_can_read_replies_to_a_thread()
    {
        $reply = create('App\Reply', ['thread_id' => $this->thread->id]);

        $this->get($this->thread->path())->assertSee($reply->body);
    }

    /** @test */
    public function a_user_can_filter_threads_accoriding_to_channel()
    {
        $channel = create('App\Channel');
        $threadInChannel = create('App\Thread', ['channel_id' => $channel->id]);

        $this->get('/threads/'. $channel->slug)->assertSee($threadInChannel->title)->assertDontSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_filter_threads_by_username()
    {
        $this->signIn(create('App\User', ['name' => 'JohnDoe']));

        $thread = create('App\Thread', ['user_id' => auth()->id()]);

        $this->get('/threads?by=JohnDoe')->assertSee($thread->title)->assertDontSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_filter_threads_by_reply_count()
    {

        $threadWithTwoReplies = create('App\Thread');
        create('App\Reply', ['thread_id' => $threadWithTwoReplies->id], 2);

        $threadWithThreeReplies = create('App\Thread');
        create('App\Reply', ['thread_id' => $threadWithThreeReplies->id], 3);

        $threadWithNoReplies = $this->thread;

        $response = $this->getJson('threads?popular=1')->json();

        $this->assertEquals([3,2,0], array_column($response, 'replies_count'));
    }

     /** @test */
    public function a_user_can_request_all_replies_with_a_thread()
    {
        create('App\Reply', ['thread_id' => $this->thread->id]);

        $response = $this->getJson($this->thread->path(). '/replies')->json();

        $this->assertCount(1, $response['data']);
        $this->assertEquals(1, $response['total']);
    }

}
