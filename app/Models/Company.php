<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'logo',
        'website',
        'slug',
    ];

    /**
     * @return hasMany
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
