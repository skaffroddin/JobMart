<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    // A Job belongs to a JobType
    public function jobType()
    {
        return $this->belongsTo(JobType::class);
    }

    // A Job belongs to a Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // A Job has many Applications
    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }

    // A Job belongs to a User (the creator of the job)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Check if the authenticated user has applied for this job
    public function userHasApplied()
    {
        return $this->applications()->where('user_id', auth()->id())->exists();
    }
}
