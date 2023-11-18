<?php

namespace Tests\Feature\Livewire\Admin\Registers;

use App\Livewire\Admin\Registers\History;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class HistoryTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(History::class)
            ->assertStatus(200);
    }
}
