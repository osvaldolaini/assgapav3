<?php

namespace Tests\Feature\Livewire\Admin\Exports;

use App\Livewire\Admin\Exports\Buttons;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ButtonsTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Buttons::class)
            ->assertStatus(200);
    }
}
