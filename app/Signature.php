<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Signature extends Model
{
    protected $fillable = [
        'signed_at', 'user_id', 'filepath', 'filename', 'email', 'dummy', 'created_at', 'updated_at', 'signed_status', 'send_to', 'applicant', 'text','document_id'
    ];

    public function user()
    {
        // return $this->hasOne(User::class);
        return $this->belongsTo(User::class);

    }
}
