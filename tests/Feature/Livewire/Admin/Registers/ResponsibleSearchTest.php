<?php

namespace Tests\Feature\Livewire\Admin\Registers;

use App\Livewire\Admin\Registers\ResponsibleSearch;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ResponsibleSearchTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(ResponsibleSearch::class)
            ->assertStatus(200);
    }
}
