<?php

namespace Tests\Feature\Livewire\Admin\Financial;

use App\Livewire\Admin\Financial\Bills;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class BillsTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Bills::class)
            ->assertStatus(200);
    }
}
