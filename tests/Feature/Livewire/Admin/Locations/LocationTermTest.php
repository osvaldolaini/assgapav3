<?php

namespace Tests\Feature\Livewire\Admin\Locations;

use App\Livewire\Admin\Locations\LocationTerm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class LocationTermTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(LocationTerm::class)
            ->assertStatus(200);
    }
}
