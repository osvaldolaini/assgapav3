<?php

namespace Tests\Feature\Livewire\Admin\Registers;

use App\Livewire\Admin\Registers\Ambiences;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AmbiencesTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Ambiences::class)
            ->assertStatus(200);
    }
}
