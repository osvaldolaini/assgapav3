<?php

namespace Tests\Feature\Livewire\Admin\Charts;

use App\Livewire\Admin\Charts\SpendingBySector;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SpendingBySectorTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(SpendingBySector::class)
            ->assertStatus(200);
    }
}
