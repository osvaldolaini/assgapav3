<?php

namespace Tests\Feature\Livewire\Admin\Monthly;

use App\Livewire\Admin\Monthly\MonthlyReleased;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class MonthlyReleasedTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(MonthlyReleased::class)
            ->assertStatus(200);
    }
}
