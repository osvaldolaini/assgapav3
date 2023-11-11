<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\SearchBar;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SearchBarTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(SearchBar::class)
            ->assertStatus(200);
    }
}
