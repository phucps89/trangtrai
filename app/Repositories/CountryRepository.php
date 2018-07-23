<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/21/2018
 * Time: 11:03 AM
 */

namespace App\Repositories;


use App\Models\Country;
use Prettus\Repository\Eloquent\BaseRepository;

class CountryRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        // TODO: Implement model() method.
        return Country::class;
    }
}
