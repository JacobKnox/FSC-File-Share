<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Report extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'reporter',
        'type',
        'reported',
        'category',
        'info',
        'resolved',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'resolved' => 'boolean',
    ];

    /**
     * Interact with the report's category.
     */
    protected function category(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucwords($value),
            set: fn (string $value) => strtolower($value)
        );
    }

    /**
     * Interact with the report's info.
     */
    protected function info(): Attribute
    {
        return Attribute::make(
            get: fn (string|null $value) => $value ?? "No additional info provided."
        );
    }

    /**
     * Interact with the report's type.
     */
    protected function type(): Attribute
    {
        return Attribute::make(
            get: fn (int $value) => config('mod.report_types')[$value],
            set: fn (int|string $value) => gettype($value) == "integer" ? $value : array_search($value, config('mod.report_types'))
        );
    }
}
