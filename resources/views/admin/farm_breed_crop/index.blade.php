@extends('admin.default')

@section('page-header')
    Quản lý loại gia súc & cây trồng
@endsection

@section('content')

    <div class="mB-20">
        <a href="{{ route(ADMIN . '.farm_breed_crop.create') }}" class="btn btn-info">
            {{ trans('app.add_button') }}
        </a>
    </div>


    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Tên</th>
                <th>Mô tả</th>
                <th>Loại</th>
                <th>Action</th>
            </tr>
            </thead>

            <tfoot>
            <tr>
                <th>Tên</th>
                <th>Mô tả</th>
                <th>Loại</th>
                <th>Action</th>
            </tr>
            </tfoot>

            <tbody>
            @foreach ($items as $item)
                <tr>
                    <td><a href="{{ route(ADMIN . '.farm_breed_crop.edit', $item->id) }}">{{ $item->name }}</a></td>
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
                    <td>

                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>

@endsection
