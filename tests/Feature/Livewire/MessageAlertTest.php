<?php

namespace Tests\Feature\Livewire;

use App\Livewire\MessageAlert;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class MessageAlertTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(MessageAlert::class)
            ->assertStatus(200);
    }
}
