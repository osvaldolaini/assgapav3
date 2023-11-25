<?php

namespace App\Mail;

use App\Models\Admin\Configs;
use App\Models\Admin\Registers\Partner;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class promotion extends Mailable
{
    use Queueable, SerializesModels;
    private $partners;
    private $config;
    private $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->config = Configs::get()->first();
        $this->partners = Partner::select('email','name')
        ->where('email','!=','')
        ->where('send_email_barthday',1)
        ->where('partner_category_master','Sócio')
        ->get();
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $tot = 0;
        $config = $this->config;
        $header = $config->addresses->address. ' - ' .$config->addresses->city.'/'.$config->addresses->state. ', Fone/Fax: '. $config->phone;
        $this->subject($this->email->title);
        foreach ($this->partners as $partner) {
            if(filter_var($partner->email, FILTER_VALIDATE_EMAIL)){
               //$tot += 1;
               //$this->subject($this->email->title.'-'.$tot);
                $this->to([$partner->email],[$partner->name]);
                //$this->to('osvaldolaini@hotmail.com','osvaldolaini');
                $this->bcc([$partner->email]);
                $this->view('admin.email.promotion',[
                    'title_postfix' => $this->email->title,
                    'config'        => $config,
                    'header'        => $header,
                    'email'         => $this->email,
                ]);
            }
        }
        // $this->subject($this->email->title.'-'.$tot);
        // //$this->to([$partner->email],[$partner->name]);
        // $this->to('osvaldolaini@hotmail.com','osvaldolaini');
        // //$this->bcc([$partner->email]);
        // $this->view('admin.email.promotion',[
        //     'title_postfix' => $this->email->title,
        //     'config'        => $config,
        //     'header'        => $header,
        //     'email'         => $this->email,
        // ]);
    }
}
