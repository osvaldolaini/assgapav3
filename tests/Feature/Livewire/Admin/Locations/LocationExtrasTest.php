<?php

namespace Tests\Feature\Livewire\Admin\Locations;

use App\Livewire\Admin\Locations\LocationExtras;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class LocationExtrasTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(LocationExtras::class)
            ->assertStatus(200);
    }
}
