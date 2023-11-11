<?php

namespace Tests\Feature\Livewire\Admin\Configs;

use App\Livewire\Admin\Configs\AmbienceTenants;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AmbienceTenantsTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(AmbienceTenants::class)
            ->assertStatus(200);
    }
}
