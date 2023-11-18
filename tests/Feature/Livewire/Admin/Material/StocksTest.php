<?php

namespace Tests\Feature\Livewire\Admin\Material;

use App\Livewire\Admin\Material\Stocks;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class StocksTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Stocks::class)
            ->assertStatus(200);
    }
}
