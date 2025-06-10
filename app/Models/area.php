<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
   protected $fillable = ['name'];

    protected $allowIncluded = ['teachers', 'courses'];

    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
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
