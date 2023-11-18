<?php

namespace Tests\Feature\Livewire\Admin\Material;

use App\Livewire\Admin\Material\Permanent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class PermanentTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Permanent::class)
            ->assertStatus(200);
    }
}
