<?php

namespace Tests\Feature\Livewire\Admin\Dashboard;

use App\Livewire\Admin\Dashboard\StatsCard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class StatsCardTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(StatsCard::class)
            ->assertStatus(200);
    }
}
