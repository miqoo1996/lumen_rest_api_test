<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'phone', 'description',
    ];

    protected $hidden = ['pivot'];

    /**
     * @return HasMany
     */
    public function userCompany(): HasMany
    {
        return $this->hasMany(UserCompany::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_companies')->withTimestamps();
    }
}
