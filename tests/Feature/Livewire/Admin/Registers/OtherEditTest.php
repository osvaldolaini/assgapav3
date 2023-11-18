<?php

namespace Tests\Feature\Livewire\Admin\Registers;

use App\Livewire\Admin\Registers\OtherEdit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class OtherEditTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(OtherEdit::class)
            ->assertStatus(200);
    }
}
