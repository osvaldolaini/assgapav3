<?php

namespace Tests\Feature\Livewire\Admin\Registers;

use App\Livewire\Admin\Registers\SelectCards;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SelectCardsTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(SelectCards::class)
            ->assertStatus(200);
    }
}
