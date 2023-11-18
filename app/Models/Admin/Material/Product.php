<?php

namespace App\Models\Admin\Material;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;


use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Product extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'products';

    protected $fillable = [
        'title','code','minimum','type','measured_unit','active','update_by','created_by'
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title']=mb_strtoupper($value);
        $this->attributes['slug']=Str::slug($value);
    }
    public function stock():HasMany
    {
        return $this->hasMany(Stock::class,'product_id','id');
    }
    public function getInStockAttribute()
    {
        $in = Stock::where('product_id', $this->id)->where('status','entrada')->sum('quantity');
        $out = Stock::where('product_id', $this->id)->where('status','saida')->sum('quantity');
        $qtd = $in-$out;

        return $qtd;
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly($this->fillable);
        // Chain fluent methods for configuration options
    }
}
