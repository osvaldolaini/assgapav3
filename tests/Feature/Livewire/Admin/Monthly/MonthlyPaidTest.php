<?php

namespace Tests\Feature\Livewire\Admin\Monthly;

use App\Livewire\Admin\Monthly\MonthlyPaid;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class MonthlyPaidTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(MonthlyPaid::class)
            ->assertStatus(200);
    }
}
