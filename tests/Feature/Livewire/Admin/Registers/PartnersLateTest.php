<?php

namespace Tests\Feature\Livewire\Admin\Registers;

use App\Livewire\Admin\Registers\PartnersLate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class PartnersLateTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(PartnersLate::class)
            ->assertStatus(200);
    }
}
