<?php

namespace App\Models\Admin\Material;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;


use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Stock extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'stocks';

    protected $fillable = [
        'quantity','status','date','product_id','update_by','created_by'
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title']=mb_strtoupper($value);
        $this->attributes['slug']=Str::slug($value);
    }
    public function stock():BelongsTo
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
    /*Setar a e pegar datas */
    public function setDateAttribute($value)
    {
        if ($value != "") {
            $this->attributes['date']=implode("-",array_reverse(explode("/",$value)));
        }else{
            $this->attributes['date']=NULL;
        }
    }
    public function getDateAttribute($value)
    {
        if ($value != "") {
            return Carbon::createFromFormat('Y-m-d', $value)
            ->format('d/m/Y');
        }
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly($this->fillable);
        // Chain fluent methods for configuration options
    }
}
