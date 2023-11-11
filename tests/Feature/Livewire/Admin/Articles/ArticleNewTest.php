<?php

namespace Tests\Feature\Livewire\Admin\Articles;

use App\Livewire\Admin\Articles\ArticleNew;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ArticleNewTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(ArticleNew::class)
            ->assertStatus(200);
    }
}
