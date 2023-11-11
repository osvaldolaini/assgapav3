<?php

namespace Tests\Feature\Livewire\Admin\Configs;

use App\Livewire\Admin\Configs\ReasonEvents;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ReasonEventsTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(ReasonEvents::class)
            ->assertStatus(200);
    }
}
