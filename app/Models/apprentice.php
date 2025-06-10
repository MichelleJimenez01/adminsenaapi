<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apprentice extends Model
{
    protected $fillable = ['name', 'email', 'cell_number', 'course_id', 'computer_id'];

    protected $allowIncluded = ['course', 'computer'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function computer()
    {
        return $this->belongsTo(Computer::class);
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
