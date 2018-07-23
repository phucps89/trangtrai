<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/21/2018
 * Time: 11:05 AM
 */

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $code
 * @property int $country_id
 * @property int $state_id
 * @property string $desc
 * @property Carbon $birthday
 * @property boolean $status
 * @property boolean $ticked
 * @property int $farm_breed_crop_id
 * @property int $farm_id
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class BreedCrop extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'breed_crop';

    /**
     * @var array
     */
    protected $fillable = ['code', 'country_id', 'state_id', 'desc', 'birthday', 'status', 'ticked', 'farm_breed_crop_id', 'farm_id', 'created_by', 'updated_by', 'created_at', 'updated_at'];

    const STATUS_NEW = 1;
    const STATUS_IMPORTED_FARM = 2;

    public static function rules($update = false, $id = null)
    {
        $commun = [
            'code'               => "required|max:255|unique:farms,code,$id",
            'desc'               => 'nullable',
            'farm_breed_crop_id' => 'required',
            'birthday'           => 'nullable',
            'country_id'         => 'nullable',
            'state_id'           => 'nullable',
            'ticked'             => 'integer:between:1,2',
            'breed_crop_id'      => 'integer',
        ];

        if ($update) {
            return $commun;
        }

        return array_merge($commun, [
        ]);
    }
}
