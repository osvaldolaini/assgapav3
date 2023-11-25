<?php

namespace Tests\Feature\Livewire\Admin\Locations;

use App\Livewire\Admin\Locations\LocationNew;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class LocationNewTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(LocationNew::class)
            ->assertStatus(200);
    }
}
