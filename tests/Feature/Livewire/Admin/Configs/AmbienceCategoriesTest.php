<?php

namespace Tests\Feature\Livewire\Admin\Configs;

use App\Livewire\Admin\Configs\AmbienceCategories;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AmbienceCategoriesTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(AmbienceCategories::class)
            ->assertStatus(200);
    }
}
