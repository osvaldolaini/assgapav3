<?php

namespace Tests\Feature\Livewire\Admin\Financial;

use App\Livewire\Admin\Financial\BillEdit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class BillEditTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(BillEdit::class)
            ->assertStatus(200);
    }
}
