<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobType extends Model
{
    use HasFactory;

    // A JobType can have many Jobs
    public function jobs()
    {
        return $this->hasMany(Job::class);  // JobType has many jobs
    }

    // A JobType belongs to one Category
    public function category()
    {
        return $this->belongsTo(Category::class);  // JobType belongs to one category
    }
}
