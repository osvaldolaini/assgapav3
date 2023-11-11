<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class MessageTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Message::class)
            ->assertStatus(200);
    }
}
