<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    /**
     * @var string
     */
    protected $table = "events";

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name'
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function workshops(): HasMany
    {
        return $this
            ->hasMany(
                Workshop::class,
                'event_id',
                'id'
            );
    }
}
