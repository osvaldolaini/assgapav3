<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\ListUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ListUserTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(ListUser::class)
            ->assertStatus(200);
    }
}
