<?php

namespace Tests\Feature\Livewire\Admin\Pool;

use App\Livewire\Admin\Pool\RegisterAccessPool;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class RegisterAccessPoolTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(RegisterAccessPool::class)
            ->assertStatus(200);
    }
}
