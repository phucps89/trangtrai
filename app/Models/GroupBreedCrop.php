<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $desc
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class GroupBreedCrop extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'group_breed_crop';

    /**
     * @var array
     */
    protected $fillable = ['name', 'desc', 'created_by', 'updated_by', 'created_at', 'updated_at'];

}
