<?php

namespace App\Models;

use App\Traits\MediaTrait;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use MediaTrait;
    protected $guarded = ['id'];
}
