@extends('site.app')
@section('title', 'Trang chủ')

@section('content')
<h2>Trang chủ</h2>
{{-- @dd($categories) --}}
@foreach ($categories as $category)
@if ($category->products->count() > 0)


<section class="section-pagetop bg-dark">
    <div class="container clearfix">
        <h2 class="title-page">{{ $category->name }}</h2>
    </div>
</section>
<section class="section-content bg padding-y">
    <div class="container">
        <div id="code_prod_complex">
            <div class="row">
                @forelse($category->products as $product)
                <div class="col-md-4">
                    <figure class="card card-product">
                        @if ($product->images->count() > 0)
                        <div class="img-wrap padding-y"><img
                                src="{{ asset('storage/'.$product->images->first()->full) }}" alt=""></div>
                        @else
                        <div class="img-wrap padding-y"><img src="https://via.placeholder.com/176" alt=""></div>
                        @endif
                        <figcaption class="info-wrap">
                            <h4 class="title"><a href="{{ route('product.show', $product->slug) }}">{{ $product->name
                                    }}</a></h4>
                        </figcaption>
                        <div class="bottom-wrap">
                            <a href="{{route('product.show', $product->slug)}}"
                                class="btn btn-sm btn-success float-right"><i class="fa fa-cart-arrow-down"></i>
                                Mua ngay</a>
                            @if ($product->sale_price != 0)
                            <div class="price-wrap h5">
                                <span class="price"> {{ config('settings.currency_symbol').$product->sale_price }}
                                </span>
                                <del class="price-old"> {{ config('settings.currency_symbol').$product->price }}</del>
                            </div>
                            @else
                            <div class="price-wrap h5">
                                <span class="price"> {{ config('settings.currency_symbol').$product->price }} </span>
                            </div>
                            @endif
                        </div>
                    </figure>
                </div>
                @empty
                <p>Không có sản phẩm nào trong {{ $category->name }}.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endif
@endforeach
@stop