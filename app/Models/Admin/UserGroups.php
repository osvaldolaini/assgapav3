<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserGroups extends Model
{
    use HasFactory;

    protected $table = 'user_groups';

    protected $fillable = [
        'id', 'title', 'acronym', 'level', 'active'
    ];

    public function users():HasMany
    {
        return $this->hasMany(User::class);
    }
}
