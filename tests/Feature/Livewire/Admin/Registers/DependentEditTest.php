<?php

namespace Tests\Feature\Livewire\Admin\Registers;

use App\Livewire\Admin\Registers\DependentEdit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class DependentEditTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(DependentEdit::class)
            ->assertStatus(200);
    }
}
