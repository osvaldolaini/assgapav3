<?php

namespace Tests\Feature\Livewire\Site\Layout;

use App\Livewire\Site\Layout\NewSeo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class NewSeoTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(NewSeo::class)
            ->assertStatus(200);
    }
}
