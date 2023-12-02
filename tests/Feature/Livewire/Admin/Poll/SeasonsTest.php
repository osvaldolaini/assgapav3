<?php

namespace Tests\Feature\Livewire\Admin\Poll;

use App\Livewire\Admin\Poll\Seasons;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SeasonsTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Seasons::class)
            ->assertStatus(200);
    }
}
