<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    protected $table = 'password_reset_tokens';

    protected $primaryKey = false;
    public $timestamps = false;

    protected $fillable = ['email', 'token'];
}
