@extends('admin.app')
@section('title') Bảng điều khiển @endsection
@section('content')
<div class="app-title">
  <div>
    <h1><i class="fa fa-dashboard"></i> Bảng điều khiển</h1>
  </div>
</div>
<div class="row">
  <div class="col-md-6 col-lg-3">
    <div class="widget-small primary coloured-icon">
      <i class="icon fa fa-users fa-3x"></i>
      <div class="info">
        <h4>Khách hàng</h4>
        <p><b>5</b></p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3">
    <div class="widget-small info coloured-icon">
      <i class="icon fa fa-thumbs-o-up fa-3x"></i>
      <div class="info">
        <h4>Số lượt thích</h4>
        <p><b>25</b></p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3">
    <div class="widget-small warning coloured-icon">
      <i class="icon fa fa-files-o fa-3x"></i>
      <div class="info">
        <h4>Số sản phẩm</h4>
        <p><b>10</b></p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3">
    <div class="widget-small danger coloured-icon">
      <i class="icon fa fa-star fa-3x"></i>
      <div class="info">
        <h4>Số sao</h4>
        <p><b>500</b></p>
      </div>
    </div>
  </div>
</div>
@endsection