<?php

namespace Tests\Feature\Livewire\Admin\Pool;

use App\Livewire\Admin\Pool\Passes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class PassesTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Passes::class)
            ->assertStatus(200);
    }
}
