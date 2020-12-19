<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = [
        'fullname', 'qrcode',
        'status_id','hometown_id', 'photo'
    ];

    protected $with = ['hometown'];


    /**
     * A staff can be part of a status
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * A staff is in a hometown
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hometown()
    {
        return $this->belongsTo(Hometown::class);
    }
}
