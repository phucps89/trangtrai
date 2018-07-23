<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/16/2018
 * Time: 8:37 PM
 */

namespace App\Http\Controllers;


use App\Libraries\Helpers;
use App\Models\Farm;
use App\Repositories\FarmRepository;
use Illuminate\Http\Request;

class FarmController extends Controller
{
    /**
     * @var FarmRepository
     */
    private $_farmRepository;

    /**
     * @param FarmRepository $farmRepository
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
            $items = $this->_farmRepository->makeModel()->newQuery()
                ->leftJoin('farm_breed_crop', 'farm_breed_crop.id', '=', 'farms.farm_breed_crop_id')
                ->select([
                    'farms.*',
                    'farm_breed_crop.name as breed_crop_name'
                ])
                ->latest('updated_at')->paginate($request->get('length'));
            foreach ($items->items() as $item) {
                $item->type_name = config('variables.farm_type')[$item->type];
                $item->action = view('admin.action', [
                    'routeEdit' => route(ADMIN . '.farm.edit', $item->id),
                    'routeDelete' => route(ADMIN . '.farm.destroy', $item->id),
                ])->render();
            }
            return Helpers::formatPaginationDataTable($items);
        }


        return view('admin.farm.index', [
            'mappingKey' => [
                'name', 'code', 'address', 'desc', 'type_name', 'breed_crop_name', 'action'
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.farm.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Farm::rules());

        $user = Helpers::getAuth();

        $this->_farmRepository->create(array_merge(
            $request->all(),
            [
                'created_by' => $user->id,
                'updated_by' => $user->id,
            ]
        ));

        return redirect()->route('admin.farm.index')->withSuccess(trans('app.success_store'));
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
        $item = $this->_farmRepository->find($id);

        return view('admin.farm.edit', compact('item'));
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
        $this->validate($request, Farm::rules(true, $id));

        $item = $this->_farmRepository->find($id);

        $item->update($request->all());

        return redirect()->route(ADMIN . '.farm.index')->withSuccess(trans('app.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->_farmRepository->delete($id);

        return back()->withSuccess(trans('app.success_destroy'));
    }
}
