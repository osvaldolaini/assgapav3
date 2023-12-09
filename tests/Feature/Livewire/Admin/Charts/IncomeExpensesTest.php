<?php

namespace Tests\Feature\Livewire\Admin\Charts;

use App\Livewire\Admin\Charts\IncomeExpenses;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class IncomeExpensesTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(IncomeExpenses::class)
            ->assertStatus(200);
    }
}
