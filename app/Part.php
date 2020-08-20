<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $fillable = [
        'title',
        'sort_order'
    ];

    public function parts()
    {
        return $this->belongsTo(Series::class);
    }
}
