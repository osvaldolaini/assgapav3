<?php

namespace Tests\Feature\Livewire\Admin\Articles;

use App\Livewire\Admin\Articles\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Article::class)
            ->assertStatus(200);
    }
}
