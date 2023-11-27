<?php

namespace Tests\Feature\Livewire\Admin\Locations;

use App\Livewire\Admin\Locations\LocationButtons;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class LocationButtonsTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(LocationButtons::class)
            ->assertStatus(200);
    }
}
