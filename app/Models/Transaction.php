<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $guarded = ['*'];

    public function user()
    {
        return $this->belongsTo(User::class,'tr_user_id');
    }
}
