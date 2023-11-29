<?php

namespace Tests\Feature\Livewire\Admin\Financial;

use App\Livewire\Admin\Financial\Cashiers;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CashiersTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Cashiers::class)
            ->assertStatus(200);
    }
}
