<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Configs extends Model
{
    use HasFactory;

    protected $table = 'configs';

    protected $fillable = [
        'title','acronym','president', 'financial','slug','update_by','logo_path',
        'email','email_happy','phone','cellphone','whatsapp','telegram','cnpj',
        'postalCode','number','address','district','city','state','complement',
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title']=mb_strtoupper($value);
        $this->attributes['slug']=Str::slug($value);
    }

}
