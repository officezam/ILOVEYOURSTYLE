<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallModel extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'call';
    protected $fillable =
        [
            'user_id',
            'call_from',
            'call_to',
            'call_date',
            'incoming_time',
            'responce_time',
            'connect_time',
            'call_duration',
            'direction',
            'call_sid',
            'call_type',
            'status',
            'response',
            'created_at',
            'created_at',
        ];



































}
