<div class="tile">
    <form action="{{ route('admin.settings.update') }}" method="POST" role="form">
        @csrf
        <h3 class="tile-title">Cài đặt chung</h3>
        <hr>
        <div class="tile-body">
            <div class="form-group">
                <label class="control-label" for="site_name">Tên Website</label>
                <input class="form-control" type="text" placeholder="Nhập tên website" id="site_name" name="site_name"
                    value="{{ config('settings.site_name') }}" />
            </div>
            <div class="form-group">
                <label class="control-label" for="site_title">Tiêu đề Website</label>
                <input class="form-control" type="text" placeholder="Nhập tiêu đề website" id="site_title"
                    name="site_title" value="{{ config('settings.site_title') }}" />
            </div>
            <div class="form-group">
                <label class="control-label" for="default_email_address">Địa chỉ Email</label>
                <input class="form-control" type="email" placeholder="Nhập địa chỉ email mặc định"
                    id="default_email_address" name="default_email_address"
                    value="{{ config('settings.default_email_address') }}" />
            </div>
            <div class="form-group">
                <label class="control-label" for="currency_code">Mã tiền tệ</label>
                <input class="form-control" type="text" placeholder="Nhập mã tiền tệ" id="currency_code"
                    name="currency_code" value="{{ config('settings.currency_code') }}" />
            </div>
            <div class="form-group">
                <label class="control-label" for="currency_symbol">Đơn vị tiền tệ </label>
                <input class="form-control" type="text" placeholder="Nhập đơn vị tiền tệ" id="currency_symbol"
                    name="currency_symbol" value="{{ config('settings.currency_symbol') }}" />
            </div>
        </div>
        <div class="tile-footer">
            <div class="row d-print-none mt-2">
                <div class="col-12 text-right">
                    <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Cập
                        nhật</button>
                </div>
            </div>
        </div>
    </form>
</div>