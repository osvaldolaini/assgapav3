<?php

namespace Tests\Feature\Livewire\Admin\Dashboard;

use App\Livewire\Admin\Dashboard\DailyReport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class DailyReportTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(DailyReport::class)
            ->assertStatus(200);
    }
}
