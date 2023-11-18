<?php

namespace Tests\Feature\Livewire\Admin\Registers;

use App\Livewire\Admin\Registers\DependentNew;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class DependentNewTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(DependentNew::class)
            ->assertStatus(200);
    }
}
