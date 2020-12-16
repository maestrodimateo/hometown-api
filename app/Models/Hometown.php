<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hometown extends Model
{
    protected $fillable = ['label', 'base_url'];


    /**
     * A hometown can have more than one Staff
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function staff()
    {
        return $this->hasMany(Staff::class);
    }
}
