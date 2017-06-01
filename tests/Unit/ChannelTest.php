<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ChannelTest extends TestCase
{
	use DatabaseMigrations;

	public function setup()
    {
        parent::setup();

        $this->channel = create('App\Channel');
    }

    /** @test */
    public function a_channel_has_threads()
    {
        $thread = create('App\Thread', ['channel_id' => $this->channel->id]);

        $this->assertTrue($this->channel->threads->contains($thread));
    }
}