<?php

namespace Tests\Feature\Livewire\Admin\Locations;

use App\Livewire\Admin\Locations\LocationEdit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class LocationEditTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(LocationEdit::class)
            ->assertStatus(200);
    }
}
