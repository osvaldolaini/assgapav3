<?php

namespace Tests\Feature\Livewire\Admin\Financial;

use App\Livewire\Admin\Financial\Receiveds;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ReceivedsTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Receiveds::class)
            ->assertStatus(200);
    }
}
