<?php

namespace Tests\Feature\Livewire\Admin\Registers;

use App\Livewire\Admin\Registers\Others;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class OthersTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Others::class)
            ->assertStatus(200);
    }
}
