<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/15/2018
 * Time: 5:12 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    protected $fillable = [
        'name',
        'address',
        'desc',
        'type',
        'type_detail',
        'created_by',
        'updated_by',
    ];
}
