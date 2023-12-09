<?php

namespace Tests\Feature\Livewire\Admin\Dashboard;

use App\Livewire\Admin\Dashboard\Reports;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ReportsTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Reports::class)
            ->assertStatus(200);
    }
}
