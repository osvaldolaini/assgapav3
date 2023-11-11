<?php

namespace Tests\Feature\Livewire\Admin\Articles;

use App\Livewire\Admin\Articles\ArticleCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ArticleCategoryTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(ArticleCategory::class)
            ->assertStatus(200);
    }
}
