<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Client extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'resume',
        'profilepic',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected static function boot()
    {
        parent::boot();

        // Listen for the creating event and generate a unique client_id
        static::creating(function ($client) {
            // Get the maximum client ID from the database
            $maxClientId = static::max('client_id');

            // Extract the numeric part of the ID and increment it by one
            $numericPart = intval(substr($maxClientId, 2));
            $newNumericPart = $numericPart + 1;

            // Generate the new client ID with leading zeros
            $newClientId = 'aa' . str_pad($newNumericPart, 3, '0', STR_PAD_LEFT);

            // Assign the new client ID to the model
            $client->client_id = $newClientId;
        });
    }

    // Define other relationships and attributes...


}
