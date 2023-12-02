<?php

namespace Tests\Feature\Livewire\Admin\Poll;

use App\Livewire\Admin\Poll\SeasonPays;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SeasonPaysTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(SeasonPays::class)
            ->assertStatus(200);
    }
}
