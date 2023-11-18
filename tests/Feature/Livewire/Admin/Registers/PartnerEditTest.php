<?php

namespace Tests\Feature\Livewire\Admin\Registers;

use App\Livewire\Admin\Registers\PartnerEdit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class PartnerEditTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(PartnerEdit::class)
            ->assertStatus(200);
    }
}
