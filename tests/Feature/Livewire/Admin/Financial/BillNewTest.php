<?php

namespace Tests\Feature\Livewire\Admin\Financial;

use App\Livewire\Admin\Financial\BillNew;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class BillNewTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(BillNew::class)
            ->assertStatus(200);
    }
}
