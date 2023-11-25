<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class birthday implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $tries = 3;
    private $partners;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($partners)
    {
       $this->partners = $partners;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
    //return new \App\Mail\birthday();
       Mail::send(new \App\Mail\birthday($this->partners));
    }
}
