<?php

namespace Tests\Feature\Livewire\Admin\Ambiences;

use App\Livewire\Admin\Ambiences\AmbiencePivotsList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AmbiencePivotsListTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(AmbiencePivotsList::class)
            ->assertStatus(200);
    }
}
