<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'tags',
        'company',
        'location',
        'email',
        'website',
        'description',
        'job_description',
        'job_requirement',
        'job_category',
        'posted_date',
        'logo'
    ];

    protected static function boot()
    {
        parent::boot();

        // Listen for the creating event and generate a unique client_id
        static::creating(function ($job) {
            $job->job_id = 'j' . str_pad(static::count() + 1, 3, '0', STR_PAD_LEFT);
        });
    }
}
