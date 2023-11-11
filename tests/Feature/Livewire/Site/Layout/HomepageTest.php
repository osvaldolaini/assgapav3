<?php

namespace Tests\Feature\Livewire\Site\Layout;

use App\Livewire\Site\Layout\Homepage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class HomepageTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Homepage::class)
            ->assertStatus(200);
    }
}
