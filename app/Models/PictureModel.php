<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PictureModel extends Model
{
    use HasFactory;


    protected $table = 'picture';
    protected $fillable = ['id', 'picture_from', 'picture_to','picture_link','picture_text','status','response'];



}
