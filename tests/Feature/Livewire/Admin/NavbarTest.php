<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\Navbar;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class NavbarTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Navbar::class)
            ->assertStatus(200);
    }
}
