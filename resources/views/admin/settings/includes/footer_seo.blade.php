<div class="tile">
    <form action="{{ route('admin.settings.update') }}" method="POST" role="form">
        @csrf
        <h3 class="tile-title">Footer &amp; SEO</h3>
        <hr>
        <div class="tile-body">
            <div class="form-group">
                <label class="control-label" for="footer_copyright_text">Văn bản bản quyền</label>
                <textarea class="form-control" rows="4" placeholder="Nhập văn bản" id="footer_copyright_text"
                    name="footer_copyright_text">{{ config('settings.footer_copyright_text') }}</textarea>
            </div>
            <div class="form-group">
                <label class="control-label" for="seo_meta_title">Tiêu đề SEO</label>
                <input class="form-control" type="text" placeholder="Nhập tiêu đề SEO" id="seo_meta_title"
                    name="seo_meta_title" value="{{ config('settings.seo_meta_title') }}" />
            </div>
            <div class="form-group">
                <label class="control-label" for="seo_meta_description">Mô tả SEO</label>
                <textarea class="form-control" rows="4" placeholder="Nhập mô tả SEO" id="seo_meta_description"
                    name="seo_meta_description">{{ config('settings.seo_meta_description') }}</textarea>
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