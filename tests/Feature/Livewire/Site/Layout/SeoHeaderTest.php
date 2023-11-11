<?php

namespace Tests\Feature\Livewire\Site\Layout;

use App\Livewire\Site\Layout\SeoHeader;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SeoHeaderTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(SeoHeader::class)
            ->assertStatus(200);
    }
}
