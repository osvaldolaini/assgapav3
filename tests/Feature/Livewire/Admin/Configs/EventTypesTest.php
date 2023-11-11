<?php

namespace Tests\Feature\Livewire\Admin\Configs;

use App\Livewire\Admin\Configs\EventTypes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class EventTypesTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(EventTypes::class)
            ->assertStatus(200);
    }
}
