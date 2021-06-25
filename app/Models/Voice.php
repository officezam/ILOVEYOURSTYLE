<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voice extends Model
{
    use HasFactory;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'voice';
    protected $fillable = ['id', 'voice_from', 'voice_to','voiceAudio','voice_text','recording','status','response'];
}
