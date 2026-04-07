<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Course extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'slug', 'price', 'description', 'image', 'status'];

    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('order');
    }

    public static function boot()
{
    parent::boot();

    static::creating(function ($course) {
        $baseSlug = Str::slug($course->name);
        $slug = $baseSlug;
        $counter = 1;

        while (Course::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }

        $course->slug = $slug;
    });
}

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments');
    }

    // Scope yêu cầu
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopePriceBetween($query, $min, $max)
    {
        return $query->whereBetween('price', [$min, $max]);
    }
}
