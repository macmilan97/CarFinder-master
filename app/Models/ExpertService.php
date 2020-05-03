<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpertService extends Model
{

    protected $guard = 'expert_services';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'price', 'expert_id',
    ];

    public function expert()
    {
        return $this->belongsTo('App\Models\Expert', 'expert_id', 'id');
    }
}
