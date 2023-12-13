<?php

namespace Tests\Feature\Livewire\Admin\Pool;

use App\Livewire\Admin\Pool\RegisterPassPool;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class RegisterPassPoolTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(RegisterPassPool::class)
            ->assertStatus(200);
    }
}
