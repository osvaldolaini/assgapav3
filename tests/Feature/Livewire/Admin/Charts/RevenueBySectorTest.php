<?php

namespace Tests\Feature\Livewire\Admin\Charts;

use App\Livewire\Admin\Charts\RevenueBySector;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class RevenueBySectorTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(RevenueBySector::class)
            ->assertStatus(200);
    }
}
