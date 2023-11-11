<?php

namespace Tests\Feature\Livewire\Site;

use App\Livewire\Site\CoachTeam;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CoachTeamTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(CoachTeam::class)
            ->assertStatus(200);
    }
}
