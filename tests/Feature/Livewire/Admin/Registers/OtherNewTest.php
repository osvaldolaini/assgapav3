<?php

namespace Tests\Feature\Livewire\Admin\Registers;

use App\Livewire\Admin\Registers\OtherNew;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class OtherNewTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(OtherNew::class)
            ->assertStatus(200);
    }
}
