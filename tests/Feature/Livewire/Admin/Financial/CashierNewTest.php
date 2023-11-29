<?php

namespace Tests\Feature\Livewire\Admin\Financial;

use App\Livewire\Admin\Financial\CashierNew;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CashierNewTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(CashierNew::class)
            ->assertStatus(200);
    }
}
