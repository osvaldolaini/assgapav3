<?php

namespace Tests\Feature\Livewire\Admin\Schedule;

use App\Livewire\Admin\Schedule\AllLocations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AllLocationsTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(AllLocations::class)
            ->assertStatus(200);
    }
}
