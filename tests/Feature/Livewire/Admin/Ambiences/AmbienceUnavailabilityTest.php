<?php

namespace Tests\Feature\Livewire\Admin\Ambiences;

use App\Livewire\Admin\Ambiences\AmbienceUnavailability;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AmbienceUnavailabilityTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(AmbienceUnavailability::class)
            ->assertStatus(200);
    }
}
