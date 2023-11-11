<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\SocialMedia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SocialMediaTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(SocialMedia::class)
            ->assertStatus(200);
    }
}
