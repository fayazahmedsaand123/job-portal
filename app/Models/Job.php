<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model {

    protected $table = 'jobs';

    protected $fillable = [
        'employer_id',
        'title',
        'description',
        'location',
        'salary',
        'job_type',
        'status',
    ];

    // Job belongs to employer
    public function employer() {
        return $this->belongsTo(User::class, 'employer_id');
    }

    // Job has many applications
    public function applications() {
        return $this->hasMany(Application::class, 'job_id');
    }
}