<?php

namespace Tests\Feature\Livewire\Admin\Location;

use App\Livewire\Admin\Location\InstallmentsLate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class InstallmentsLateTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(InstallmentsLate::class)
            ->assertStatus(200);
    }
}
