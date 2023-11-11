<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\SideBar;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SideBarTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(SideBar::class)
            ->assertStatus(200);
    }
}
