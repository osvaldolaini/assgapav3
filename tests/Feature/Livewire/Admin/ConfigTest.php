<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\Config;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ConfigTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Config::class)
            ->assertStatus(200);
    }
}
