<?php

namespace Tests\Feature\Livewire\Admin\Dashboard;

use App\Livewire\Admin\Dashboard\Secretary;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SecretaryTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Secretary::class)
            ->assertStatus(200);
    }
}
