<?php

namespace Tests\Feature\Livewire\Admin\Dashboard;

use App\Livewire\Admin\Dashboard\Master;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class MasterTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Master::class)
            ->assertStatus(200);
    }
}
