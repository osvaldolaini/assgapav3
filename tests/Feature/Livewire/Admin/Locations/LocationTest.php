<?php

namespace Tests\Feature\Livewire\Admin\Locations;

use App\Livewire\Admin\Locations\Location;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class LocationTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Location::class)
            ->assertStatus(200);
    }
}
