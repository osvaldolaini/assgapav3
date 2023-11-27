<?php

namespace Tests\Feature\Livewire\Admin\Locations;

use App\Livewire\Admin\Locations\LocationContract;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class LocationContractTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(LocationContract::class)
            ->assertStatus(200);
    }
}
