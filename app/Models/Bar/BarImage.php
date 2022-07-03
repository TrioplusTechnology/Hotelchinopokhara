<?php

namespace App\Models\Bar;

use App\Traits\CreatedUpdatedTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarImage extends Model
{
    use HasFactory,
        CreatedUpdatedTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bar_images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'bar_id',
        'front_show',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    /**
     * Bar
     */
    public function bar()
    {
        return $this->belongsTo(Bar::class, 'bar_id');
    }
}
