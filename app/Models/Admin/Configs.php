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
        'id','title','slug','acronym','logo_path','cpf_cnpj','email','phone',
        'cellphone','whatsapp','telegram','about' ,'updated_by','meta_description',
        'meta_tags','video_link','postalCode','number','address','district','city','state'
        ,'complement'
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title']=$value;
        $this->attributes['slug']=Str::slug($value);
    }

}
