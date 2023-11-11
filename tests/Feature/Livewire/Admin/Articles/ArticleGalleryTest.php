<?php

namespace Tests\Feature\Livewire\Admin\Articles;

use App\Livewire\Admin\Articles\ArticleGallery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ArticleGalleryTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(ArticleGallery::class)
            ->assertStatus(200);
    }
}
