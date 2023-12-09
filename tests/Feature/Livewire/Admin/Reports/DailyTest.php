<?php

namespace Tests\Feature\Livewire\Admin\Reports;

use App\Livewire\Admin\Reports\Daily;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class DailyTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Daily::class)
            ->assertStatus(200);
    }
}
