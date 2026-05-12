<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model {

    protected $table = 'applications';

    protected $fillable = [
        'job_id',
        'candidate_id',
        'resume_path',
        'application_status',
    ];

    // Application belongs to a job
    public function job() {
        return $this->belongsTo(Job::class, 'job_id');
    }

    // Application belongs to a candidate
    public function candidate() {
        return $this->belongsTo(User::class, 'candidate_id');
    }
}