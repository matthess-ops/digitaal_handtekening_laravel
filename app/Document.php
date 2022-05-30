<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    public function signature()
    {
        return $this->hasOne(Signature::class);
    }
}
