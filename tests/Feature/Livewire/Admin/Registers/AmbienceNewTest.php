<?php

namespace Tests\Feature\Livewire\Admin\Registers;

use App\Livewire\Admin\Registers\AmbienceNew;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AmbienceNewTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(AmbienceNew::class)
            ->assertStatus(200);
    }
}
