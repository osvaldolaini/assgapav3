<?php

namespace Tests\Feature\Livewire\Admin\Dashboard;

use App\Livewire\Admin\Dashboard\Director;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class DirectorTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Director::class)
            ->assertStatus(200);
    }
}
