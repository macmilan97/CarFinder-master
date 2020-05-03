<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{

    const STATUS_NO = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DONE = 2;
    const STATUS_REFUSE = 3;

    const TYPE_CHECK = 1;
    const TYPE_PICK_UP = 2;

}
