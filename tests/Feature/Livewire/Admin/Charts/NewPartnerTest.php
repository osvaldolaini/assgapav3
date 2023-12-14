<?php

namespace Tests\Feature\Livewire\Admin\Charts;

use App\Livewire\Admin\Charts\NewPartner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class NewPartnerTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(NewPartner::class)
            ->assertStatus(200);
    }
}
