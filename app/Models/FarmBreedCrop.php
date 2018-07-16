<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/15/2018
 * Time: 5:18 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class FarmBreedCrop extends Model
{
    const FARM_TYPE_BREED = 1;
    const FARM_TYPE_CROP = 2;

    protected $table = 'farm_breed_crop';

    protected $fillable = [
        'name',
        'desc',
        'type',
    ];

    public static function rules($update = false, $id = null)
    {
        $commun = [
            'name' => "required|max:255|unique:farm_breed_crop,name,$id",
            'desc' => 'nullable',
            'type' => 'integer:between:1,2',
        ];

        if ($update) {
            return $commun;
        }

        return array_merge($commun, [
        ]);
    }
}
