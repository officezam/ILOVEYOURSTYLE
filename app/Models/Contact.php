<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;



    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contacts';
    protected $fillable = [
        'first_name',
        'last_name',
        'company_name',
        'email',
        'home_phone',
        'work_phone',
        'mobile_phone',
        'created_by_id',
        'compaign_id',
        'remember_token',
        'list_id'
    ];

}
