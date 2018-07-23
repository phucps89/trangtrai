<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/15/2018
 * Time: 5:48 PM
 */

namespace App\Http\Controllers;


use App\Models\FarmBreedCrop;
use App\Repositories\FarmBreedCropRepository;
use Illuminate\Http\Request;

class FarmBreedCropController extends Controller
{
    /**
     * @var FarmBreedCropRepository
     */
    private $_farmBreedCropRepository;

    /**
     * @param FarmBreedCropRepository $farmBreedCropRepository
     */
    public function __construct(FarmBreedCropRepository $farmBreedCropRepository)
    {
        $this->_farmBreedCropRepository = $farmBreedCropRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = Request::capture();
        if($request->ajax()){
            $type = $request->get('type');
            $query = $this->_farmBreedCropRepository->makeModel()->newQuery();
            if(in_array($type, array_keys(config('variables.farm_type')))){
                $query->where('type', $type);
            }
            return $query->get([
                'id', 'name'
            ]);
        }

        $items = $this->_farmBreedCropRepository->makeModel()->newQuery()->latest('updated_at')->get();

        return view('admin.farm_breed_crop.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.farm_breed_crop.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, FarmBreedCrop::rules());

        $this->_farmBreedCropRepository->create($request->all());

        return redirect()->route('admin.farm_breed_crop.index')->withSuccess(trans('app.success_store'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->_farmBreedCropRepository->find($id);

        return view('admin.farm_breed_crop.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, FarmBreedCrop::rules(true, $id));

        $item = $this->_farmBreedCropRepository->find($id);

        $item->update($request->all());

        return redirect()->route(ADMIN . '.farm_breed_crop.index')->withSuccess(trans('app.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->_farmBreedCropRepository->delete($id);

        return back()->withSuccess(trans('app.success_destroy'));
    }
}
