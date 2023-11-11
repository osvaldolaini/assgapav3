<?php

namespace Tests\Feature\Livewire\Site\Layout;

use App\Livewire\Site\Layout\NavigationMenu;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class NavigationMenuTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(NavigationMenu::class)
            ->assertStatus(200);
    }
}
