<?php

namespace Tests\Feature\Livewire\Admin\Locations;

use App\Livewire\Admin\Locations\LocationInstallment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class LocationInstallmentTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(LocationInstallment::class)
            ->assertStatus(200);
    }
}
