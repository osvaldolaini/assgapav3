<?php

namespace Tests\Feature\Livewire\Site\Layout;

use App\Livewire\Site\Layout\Google;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class GoogleTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Google::class)
            ->assertStatus(200);
    }
}
