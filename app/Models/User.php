<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    // One employer has many jobs
    public function jobs() {
        return $this->hasMany(Job::class, 'employer_id');
    }

    // One candidate has many applications
    public function applications() {
        return $this->hasMany(Application::class, 'candidate_id');
    }
}