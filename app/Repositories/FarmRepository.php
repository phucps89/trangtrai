<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/15/2018
 * Time: 5:13 PM
 */

namespace App\Repositories;


use App\Models\Farm;
use Prettus\Repository\Eloquent\BaseRepository;

class FarmRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        // TODO: Implement model() method.
        return Farm::class;
    }
}
