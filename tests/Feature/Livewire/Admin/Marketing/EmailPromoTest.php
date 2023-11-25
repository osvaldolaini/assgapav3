<?php

namespace Tests\Feature\Livewire\Admin\Marketing;

use App\Livewire\Admin\Marketing\EmailPromo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class EmailPromoTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(EmailPromo::class)
            ->assertStatus(200);
    }
}
