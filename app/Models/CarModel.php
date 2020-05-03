<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class CarModel extends Model
{

    use Translatable;

    protected $translatable = ['title'];
}
