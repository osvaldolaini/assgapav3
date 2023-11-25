<?php

namespace Tests\Feature\Livewire\Admin\Schedule;

use App\Livewire\Admin\Schedule\LocationCalendar;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class LocationCalendarTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(LocationCalendar::class)
            ->assertStatus(200);
    }
}
