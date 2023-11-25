<?php

namespace Tests\Feature\Livewire\Admin\Marketing;

use App\Livewire\Admin\Marketing\EmailBirth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class EmailBirthTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(EmailBirth::class)
            ->assertStatus(200);
    }
}
