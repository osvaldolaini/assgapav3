<?php

namespace Tests\Feature\Livewire\Admin\Marketing;

use App\Livewire\Admin\Marketing\EmailPromoNew;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class EmailPromoNewTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(EmailPromoNew::class)
            ->assertStatus(200);
    }
}
