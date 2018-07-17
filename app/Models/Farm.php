<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $code
 * @property boolean $type
 * @property int $breed_crop_id
 * @property string $address
 * @property string $desc
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Farm extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'code', 'type', 'breed_crop_id', 'address', 'desc', 'created_by', 'updated_by', 'created_at', 'updated_at'];

    public function getFarmTypeName(){
        return config('app.variable.farm_type')[$this->type];
    }

    public function farm_breed_crop(){
        return $this->belongsTo(FarmBreedCrop::class, 'breed_crop_id');
    }
}
