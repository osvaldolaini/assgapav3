<?php

namespace Tests\Feature\Livewire\Admin\Marketing;

use App\Livewire\Admin\Marketing\Lists;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ListsTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Lists::class)
            ->assertStatus(200);
    }
}
