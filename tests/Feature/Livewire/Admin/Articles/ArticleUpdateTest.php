<?php

namespace Tests\Feature\Livewire\Admin\Articles;

use App\Livewire\Admin\Articles\ArticleUpdate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ArticleUpdateTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(ArticleUpdate::class)
            ->assertStatus(200);
    }
}
