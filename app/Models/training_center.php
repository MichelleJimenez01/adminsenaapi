<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training_center extends Model
{
     // Campos permitidos para asignación masiva
    protected $fillable = ['name', 'location'];

    // Lista blanca de relaciones que pueden ser cargadas dinámicamente
    protected $allowIncluded = ['teachers', 'courses'];

    /**
     * Relación uno a muchos con Teacher
     */
    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }

    /**
     * Relación uno a muchos con Course
     */
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    /**
     * Scope para incluir relaciones según la query ?included=...
     */
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
