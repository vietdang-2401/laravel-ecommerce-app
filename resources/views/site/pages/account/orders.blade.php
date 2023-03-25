@extends('site.app')
@section('title', 'Orders')
@section('content')
<section class="section-pagetop bg-dark">
    <div class="container clearfix">
        <h2 class="title-page">Quản lý đơn hàng </h2>
    </div>
</section>
<section class="section-content bg padding-y border-top">
    <div class="container">
        <div class="row">
        </div>
        <div class="row">
            <main class="col-sm-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Mã đơn hàng</th>
                            <th scope="col">Họ</th>
                            <th scope="col">Tên</th>
                            <th scope="col">Đơn giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                        <tr>
                            <th scope="row">{{ $order->order_number }}</th>
                            <td>{{ $order->first_name }}</td>
                            <td>{{ $order->last_name }}</td>
                            <td>{{ config('settings.currency_symbol') }}{{ round($order->grand_total, 2) }}</td>
                            <td>{{ $order->item_count }}</td>
                            <td><span class="badge badge-success">{{ strtoupper($order->status) }}</span></td>
                        </tr>
                        @empty
                        <div class="col-sm-12">
                            <p class="alert alert-warning">No orders to display.</p>
                        </div>
                        @endforelse
                    </tbody>
                </table>
            </main>
        </div>
    </div>
</section>
@stop