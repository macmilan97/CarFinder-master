<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpertDocument extends Model
{

    protected $guard = 'expert_documents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'filename', 'filepath', 'status', 'expert_id',
    ];

    public function expert()
    {
        return $this->belongsTo('App\Models\Expert', 'expert_id', 'id');
    }
}
