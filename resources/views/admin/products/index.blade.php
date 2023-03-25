@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
        <p>{{ $subTitle }}</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary pull-right">Thêm sản phẩm</a>
</div>
@include('admin.partials.flash')
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <table class="table table-hover table-bordered" id="sampleTable">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> SKU </th>
                            <th> Tên sản phẩm </th>
                            <th class="text-center"> Thương hiệu </th>
                            <th class="text-center"> Danh mục </th>
                            <th class="text-center"> Giá </th>
                            <th class="text-center"> Trạng thái </th>
                            <th style="width:100px; min-width:100px;" class="text-center text-danger"><i
                                    class="fa fa-bolt"> </i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->sku }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->brand->name }}</td>
                            <td>
                                @foreach($product->categories as $category)
                                <span class="badge badge-info">{{ $category->name }}</span>
                                @endforeach
                            </td>
                            <td>{{ config('settings.currency_symbol') }}{{ $product->price }}</td>
                            <td class="text-center">
                                @if ($product->status == 1)
                                <span class="badge badge-success">Còn bán</span>
                                @else
                                <span class="badge badge-danger">Đã ngừng bán</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Second group">
                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                        class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('admin.products.delete', $product->id) }}"
                                        class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
    $('#sampleTable').DataTable();
</script>
@endpush