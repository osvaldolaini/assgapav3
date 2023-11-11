<?php

namespace Tests\Feature\Livewire\Admin\Register;

use App\Livewire\Admin\Register\PartnerCategories;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class PartnerCategoriesTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(PartnerCategories::class)
            ->assertStatus(200);
    }
}
