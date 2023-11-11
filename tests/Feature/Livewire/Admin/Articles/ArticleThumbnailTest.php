<?php

namespace Tests\Feature\Livewire\Admin\Articles;

use App\Livewire\Admin\Articles\ArticleThumbnail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ArticleThumbnailTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(ArticleThumbnail::class)
            ->assertStatus(200);
    }
}
