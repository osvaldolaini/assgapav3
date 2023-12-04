<?php

namespace Tests\Feature\Livewire\Admin\Monthly;

use App\Livewire\Admin\Monthly\Monthlys;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class MonthlysTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Monthlys::class)
            ->assertStatus(200);
    }
}
