<?php

namespace Tests\Feature\Livewire\Admin\Configs;

use App\Livewire\Admin\Configs\CostCenters;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CostCentersTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(CostCenters::class)
            ->assertStatus(200);
    }
}
