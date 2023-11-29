<?php

namespace Tests\Feature\Livewire\Admin\Financial;

use App\Livewire\Admin\Financial\CashierEdit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CashierEditTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(CashierEdit::class)
            ->assertStatus(200);
    }
}
