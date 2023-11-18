<?php

namespace Tests\Feature\Livewire\Admin\Material;

use App\Livewire\Admin\Material\Consumption;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ConsumptionTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Consumption::class)
            ->assertStatus(200);
    }
}
