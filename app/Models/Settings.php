<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'email',
        'phone',
        'address',
        'description',
        'facebook',
        'x',
        'linkedin',
        'youtube',
        'tiktok',
        'bank_name',
        'account_number',
        'swift_bic_code',
        'beneficiary',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'phone' => 'array',
        ];
    }

    /**
     * Get the singleton settings instance.
     */
    public static function getInstance(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
