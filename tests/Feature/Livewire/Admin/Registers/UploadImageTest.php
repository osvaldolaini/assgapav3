<?php

namespace Tests\Feature\Livewire\Admin\Registers;

use App\Livewire\Admin\Registers\UploadImage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class UploadImageTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(UploadImage::class)
            ->assertStatus(200);
    }
}
