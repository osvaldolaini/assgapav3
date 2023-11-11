<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserAccess extends Model
{
    use HasFactory;

    protected $table = 'user_accesses';

    protected $fillable = [
        'id', 'user_id', 'page_id'
    ];

    public function users():HasMany
    {
        return $this->hasMany(User::class);
    }
}
