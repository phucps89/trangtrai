<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/16/2018
 * Time: 8:37 PM
 */

namespace App\Http\Controllers;


use App\Repositories\FarmRepository;
use Illuminate\Http\Request;

class FarmController extends Controller
{
    /**
     * @var FarmRepository
     */
    private $_farmRepository;

    /**
     * FarmBreedCropController constructor.
     */
    public function __construct(FarmRepository $farmRepository)
    {
        $this->_farmRepository = $farmRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = Request::capture();
        $isAjax = $request->get('ajax', 0);
        if($isAjax == 1){
            $items = $this->_farmRepository->makeModel()->newQuery()->latest('updated_at')->paginate();
//            $data = [];
//            foreach ($items->items() as $item) {
//                $data[] = array_values($item->toArray());
//            }
            return [
                'draw' => $request->get('draw'),
                'recordsTotal' => $items->total(),
                'recordsFiltered' => count($items->items()),
                'data' => $items->items(),
                'all' => $request->all()
            ];
        }


        return view('admin.farm.index');
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
