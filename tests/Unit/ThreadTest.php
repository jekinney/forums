<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadTest extends TestCase
{
	use DatabaseMigrations;

	public function setup()
    {
        parent::setup();

        $this->thread = create('App\Thread');
    }

    /** @test */
    public function a_thread_can_make_a_string_path()
    {
        $this->assertEquals("/threads/{$this->thread->channel->slug}/{$this->thread->id}", $this->thread->path());
    }

    /** @test */
    public function a_thread_has_replies()
    {
       $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }

     /** @test */
    public function a_thread_has_a_creator()
    {
       $this->assertInstanceOf('App\User', $this->thread->creator);
    }

    /** @test */
    public function a_thread_can_add_a_reply()
    {
        $this->thread->addReply(['body' => 'fooBar', 'user_id' => 1]);

        $this->assertCount(1, $this->thread->replies);
    }

    /** @test */ 
    public function a_thread_belongs_to_a_channel()
    {
        $this->assertinstanceOf('App\Channel', $this->thread->channel);
    }
}
