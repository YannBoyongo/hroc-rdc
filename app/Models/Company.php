<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'intro',
        'about',
        'vision',
        'mission',
    ];

    /**
     * Get the singleton company instance.
     */
    public static function getInstance(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
