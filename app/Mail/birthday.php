<?php

namespace App\Mail;

use App\Model\Admin\Config;
use App\Models\Admin\Configs;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class birthday extends Mailable
{
    use Queueable, SerializesModels;
    private $partner;
    private $config;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($partner)
    {
        $this->config = Configs::get()->first();
        $this->partner = $partner;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $config = $this->config;
        $partner = $this->partner;
        if(filter_var($partner->email, FILTER_VALIDATE_EMAIL)){
            $this->subject('Feliz aniversário '. $partner->name);
            $this->to([$partner->email],[$partner->name]);
            $this->view('admin.email.birthday',[
                'title_postfix' => 'Email de aniversário',
                'config'        => $config,
                'name'          => $partner->name,
            ]);
        }
    }
}
