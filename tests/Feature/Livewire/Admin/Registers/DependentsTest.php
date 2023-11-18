<?php

namespace Tests\Feature\Livewire\Admin\Registers;

use App\Livewire\Admin\Registers\Dependents;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class DependentsTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Dependents::class)
            ->assertStatus(200);
    }
}
