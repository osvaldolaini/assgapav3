<?php

namespace Tests\Feature\Livewire\Admin\Marketing;

use App\Livewire\Admin\Marketing\EmailPromoEdit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class EmailPromoEditTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(EmailPromoEdit::class)
            ->assertStatus(200);
    }
}
