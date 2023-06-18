<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuItem extends Model
{
    /**
     * @var string
     */
    protected $table = "menu_items";

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'url'
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function children(): HasMany
    {
        return $this
            ->hasMany(
                self::class,
                'parent_id',
                'id'
            );
    }
}
