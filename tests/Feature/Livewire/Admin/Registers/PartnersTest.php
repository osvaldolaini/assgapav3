<?php

namespace Tests\Feature\Livewire\Admin\Registers;

use App\Livewire\Admin\Registers\Partners;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class PartnersTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Partners::class)
            ->assertStatus(200);
    }
}
