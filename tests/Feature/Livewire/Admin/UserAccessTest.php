<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\UserAccess;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class UserAccessTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(UserAccess::class)
            ->assertStatus(200);
    }
}
