<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
     protected $fillable = ['course_number', 'day', 'area_id', 'training_center_id'];

    protected $allowIncluded = ['area', 'trainingCenter', 'teachers', 'apprentices'];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function trainingCenter()
    {
        return $this->belongsTo(TrainingCenter::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'course_teacher');
    }

    public function apprentices()
    {
        return $this->hasMany(Apprentice::class);
    }

    public function scopeIncluded(Builder $query)
    {
        $relations = explode(',', request('included'));
        $allowed = collect($this->allowIncluded);

        foreach ($relations as $key => $relation) {
            if (!$allowed->contains($relation)) {
                unset($relations[$key]);
            }
        }

        return $query->with($relations);
    }
}
