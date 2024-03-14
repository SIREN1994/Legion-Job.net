<?php

namespace App\Models;

use App\Models\Jobs;
use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Record extends Model
{
    use HasFactory;
    protected $fillable = [
        "client_id",
        "job_id",
        'client_name',
        'client_email',
        'job_title',
        'company_name',
    ];
}
