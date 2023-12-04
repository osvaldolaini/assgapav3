<?php

namespace Tests\Feature\Livewire\Admin\Registers;

use App\Livewire\Admin\Registers\OtherFast;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class OtherFastTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(OtherFast::class)
            ->assertStatus(200);
    }
}
