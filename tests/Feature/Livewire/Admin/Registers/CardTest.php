<?php

namespace Tests\Feature\Livewire\Admin\Registers;

use App\Livewire\Admin\Registers\Card;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CardTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Card::class)
            ->assertStatus(200);
    }
}
