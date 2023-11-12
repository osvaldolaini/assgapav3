<?php

namespace Tests\Feature\Livewire\Admin\Registers;

use App\Livewire\Admin\Registers\AmbienceEdit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AmbienceEditTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(AmbienceEdit::class)
            ->assertStatus(200);
    }
}
