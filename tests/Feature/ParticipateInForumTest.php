<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInForumTest extends TestCase
{
	use DatabaseMigrations;

    /** @test */
    public function an_unauthenticated_user_may_not_participate_in_forum_threads()
    {
        $this->withExceptionHandling()->post('/threads/some-channel/1/replies', []);
    }

    /** @test */
    public function an_authenticated_user_may_participate_in_forum_threads()
    {
        $this->signIn();

        $thread = create('App\Thread');

        $reply = make('App\Reply', ['thread_id' => $thread->id]);

        $this->post($thread->path() .'/replies', $reply->toArray());

        $this->get($thread->path())->assertSee($reply->body);
    }

    /** @test */
    public function a_reply_requires_a_body()
    {
        $this->withExceptionHandling()->signIn();

        $thread = create('App\Thread');
        $reply = make('App\Reply', ['body' => null]);

        $this->post($thread->path(). '/replies', $reply->toArray())->assertSessionHasErrors('body');
    }

    /** @test */
    public function unauthorized_users_cannot_delete_replies()
    {
        $this->withExceptionHandling();

        $reply = create('App\Reply');

        $this->delete("/replies/{$reply->id}")->assertRedirect('login');

        $this->signIn()->delete("/replies/{$reply->id}")->assertStatus(403);
    }

    /** @test */
    public function authorized_users_can_delete_own_reply()
    {
        $this->withExceptionHandling();

        $this->signIn();

        $reply = create('App\Reply', ['user_id' => auth()->id()]);

        $this->delete("/replies/{$reply->id}")->assertStatus(302);

        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
    }

    /** @test */
    public function unauthorized_users_cannot_update_reply()
    {
        $this->withExceptionHandling();

        $reply = create('App\Reply');

        $this->patch("/replies/{$reply->id}")->assertredirect('login');

        $this->signIn()->patch("/replies/{$reply->id}")->assertStatus(403);
    }

    /** @test */
    public function authorized_users_can_update_own_reply()
    {
        //$this->withExceptionHandling();

        $this->signIn();

        $reply = create('App\Reply', ['user_id' => auth()->id()]);

        $this->patch("/replies/{$reply->id}", ['body' => 'You been changed fool']);

        $this->assertDatabaseHas('replies', ['id' => $reply->id, 'body' => 'You been changed fool']);
    }
}
