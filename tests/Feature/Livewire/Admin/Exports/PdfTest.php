<?php

namespace Tests\Feature\Livewire\Admin\Exports;

use App\Livewire\Admin\Exports\Pdf;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class PdfTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Pdf::class)
            ->assertStatus(200);
    }
}
