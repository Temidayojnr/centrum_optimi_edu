<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Program extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'featured_image',
        'status',
        'start_date',
        'end_date',
        'location',
        'beneficiaries',
        'budget',
        'is_featured',
        'is_published',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'budget' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($program) {
            if (empty($program->slug)) {
                $program->slug = Str::slug($program->title);
            }
        });
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function galleryItems()
    {
        return $this->hasMany(GalleryItem::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
