<?php

namespace Tests\Feature\Livewire\Admin\Location;

use App\Livewire\Admin\Location\MultipleLocation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class MultipleLocationTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(MultipleLocation::class)
            ->assertStatus(200);
    }
}
