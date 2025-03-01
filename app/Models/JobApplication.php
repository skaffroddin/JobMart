<?php
// JobApplication.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    // Define the user relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function job(){
        return $this->belongsTo(Job::class);
    }
    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }
    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }
    public function userHasApplied()
{
    return $this->applications()->where('user_id', auth()->id())->exists();
}

}
