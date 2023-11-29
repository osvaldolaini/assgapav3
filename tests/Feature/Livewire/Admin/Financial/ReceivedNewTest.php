<?php

namespace Tests\Feature\Livewire\Admin\Financial;

use App\Livewire\Admin\Financial\ReceivedNew;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ReceivedNewTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(ReceivedNew::class)
            ->assertStatus(200);
    }
}
