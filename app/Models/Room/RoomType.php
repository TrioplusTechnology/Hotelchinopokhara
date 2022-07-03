<?php

namespace App\Models\Room;

use App\Traits\CreatedUpdatedTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory,
        CreatedUpdatedTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'room_type';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'order',
        'status',
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
     * Get the post that owns the mapping.
     */
    public function features()
    {
        return $this->belongsToMany(RoomFeature::class, 'room_feature_mappings', 'room_id', 'room_feature_id');
    }

    public function images()
    {
        return $this->hasMany(RoomImage::class, 'room_id');
    }
}
