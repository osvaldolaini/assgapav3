<?php

namespace Tests\Feature\Livewire\Admin\Financial;

use App\Livewire\Admin\Financial\ReceivedEdit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ReceivedEditTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(ReceivedEdit::class)
            ->assertStatus(200);
    }
}
