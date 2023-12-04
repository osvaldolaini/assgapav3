<?php

namespace Tests\Feature\Livewire\Admin\Monthly;

use App\Livewire\Admin\Monthly\MonthlyUnpaid;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class MonthlyUnpaidTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(MonthlyUnpaid::class)
            ->assertStatus(200);
    }
}
