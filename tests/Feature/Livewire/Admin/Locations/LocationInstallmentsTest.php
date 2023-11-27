<?php

namespace Tests\Feature\Livewire\Admin\Locations;

use App\Livewire\Admin\Locations\LocationInstallments;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class LocationInstallmentsTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(LocationInstallments::class)
            ->assertStatus(200);
    }
}
