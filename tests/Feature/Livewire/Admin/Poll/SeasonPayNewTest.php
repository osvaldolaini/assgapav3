<?php

namespace Tests\Feature\Livewire\Admin\Poll;

use App\Livewire\Admin\Poll\SeasonPayNew;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SeasonPayNewTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(SeasonPayNew::class)
            ->assertStatus(200);
    }
}
