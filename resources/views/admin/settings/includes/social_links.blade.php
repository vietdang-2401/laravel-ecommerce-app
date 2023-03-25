<div class="tile">
    <form action="{{ route('admin.settings.update') }}" method="POST" role="form">
        @csrf
        <h3 class="tile-title">Liên hệ</h3>
        <hr>
        <div class="tile-body">
            <div class="form-group">
                <label class="control-label" for="social_facebook">Link Facebook</label>
                <input class="form-control" type="text" placeholder="Nhập link đến trang cá nhân của bạn"
                    id="social_facebook" name="social_facebook" value="{{ config('settings.social_facebook') }}" />
            </div>
            <div class="form-group">
                <label class="control-label" for="social_twitter">Link Twitter</label>
                <input class="form-control" type="text" placeholder="Nhập link đến trang cá nhân của bạn"
                    id="social_twitter" name="social_twitter" value="{{ config('settings.social_twitter') }}" />
            </div>
            <div class="form-group">
                <label class="control-label" for="social_instagram">Link Instagram</label>
                <input class="form-control" type="text" placeholder="Nhập link đến trang cá nhân của bạn"
                    id="social_instagram" name="social_instagram" value="{{ config('settings.social_instagram') }}" />
            </div>
            <div class="form-group">
                <label class="control-label" for="social_linkedin">Link LinkedIn</label>
                <input class="form-control" type="text" placeholder="Nhập link đến trang cá nhân của bạn"
                    id="social_linkedin" name="social_linkedin" value="{{ config('settings.social_linkedin') }}" />
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