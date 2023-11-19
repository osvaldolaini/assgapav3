<?php

namespace Tests\Feature\Livewire\Admin\Material;

use App\Livewire\Admin\Material\MovementStock;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class MovementStockTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(MovementStock::class)
            ->assertStatus(200);
    }
}
