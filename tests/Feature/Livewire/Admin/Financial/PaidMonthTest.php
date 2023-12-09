<?php

namespace Tests\Feature\Livewire\Admin\Financial;

use App\Livewire\Admin\Financial\PaidMonth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class PaidMonthTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(PaidMonth::class)
            ->assertStatus(200);
    }
}
