@extends('admin.default')

@section('page-header')
    Quản lý chuồng trại
@endsection

@section('content')

    <div class="mB-20">
        <a href="{{ route(ADMIN . '.farm.create') }}" class="btn btn-info">
            {{ trans('app.add_button') }}
        </a>
    </div>


    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <table data-column-defs='{{json_encode([
            [
                'targets' => 0,
                'data' => 'name',
            ],
            [
                'targets' => 1,
                'data' => 'code',
            ],
            [
                'targets' => 2,
                'data' => 'address',
            ],
            [
                'targets' => 3,
                'data' => 'desc',
            ],
            [
                'targets' => 4,
                'data' => 'name',
            ],
            [
                'targets' => 5,
                'data' => 'name',
            ],
            [
                'targets' => 6,
                'data' => 'name',
            ],
        ])}}' data-url="{{route(ADMIN . '.farm.index', ['ajax'=>1])}}" class="ajax-dataTable table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Tên</th>
                <th>Mã</th>
                <th>Địa điểm</th>
                <th>Mô tả</th>
                <th>Loại</th>
                <th>Chủng loài</th>
                <th>Action</th>
            </tr>
            </thead>

            <tfoot>
            <tr>
                <th>Tên</th>
                <th>Mã</th>
                <th>Địa điểm</th>
                <th>Mô tả</th>
                <th>Loại</th>
                <th>Chủng loài</th>
                <th>Action</th>
            </tr>
            </tfoot>

            <tbody>
            @if(!empty($items))
                @foreach ($items as $item)
                    <tr>
                        <td><a href="{{ route(ADMIN . '.farm_breed_crop.edit', $item->id) }}">{{ $item->name }}</a></td>
                        <td>{{ $item->code }}</td>
                        <td>{{ $item->address }}</td>
                        <td>{{ $item->desc }}</td>
                        <td>
                            @if($item->type == \App\Models\FarmBreedCrop::FARM_TYPE_BREED)
                                <span class="badge badge-pill badge-success lh-0 p-10">Gia súc</span>
                            @elseif($item->type == \App\Models\FarmBreedCrop::FARM_TYPE_CROP)
                                <span class="badge badge-pill badge-info lh-0 p-10">Cây trồng</span>
                            @else
                                <span class="badge badge-pill badge-warning lh-0 p-10">Undefined</span>
                            @endif
                        </td>
                        <td>{{ $item->farm_breed_crop->name }}</td>
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="{{ route(ADMIN . '.farm.edit', $item->id) }}" title="{{ trans('app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>
                                <li class="list-inline-item">
                                    {!! Form::open([
                                        'class'=>'delete',
                                        'url'  => route(ADMIN . '.farm.destroy', $item->id),
                                        'method' => 'DELETE',
                                        ])
                                    !!}

                                    <button class="btn btn-danger btn-sm" title="{{ trans('app.delete_title') }}"><i class="ti-trash"></i></button>

                                    {!! Form::close() !!}
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>

        </table>
    </div>

@endsection
