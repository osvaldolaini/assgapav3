<?php

namespace Tests\Feature\Livewire\Admin\Poll;

use App\Livewire\Admin\Poll\SeasonPayEdit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SeasonPayEditTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(SeasonPayEdit::class)
            ->assertStatus(200);
    }
}
