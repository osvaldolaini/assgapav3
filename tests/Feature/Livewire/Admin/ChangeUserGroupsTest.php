<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\ChangeUserGroups;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ChangeUserGroupsTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(ChangeUserGroups::class)
            ->assertStatus(200);
    }
}
