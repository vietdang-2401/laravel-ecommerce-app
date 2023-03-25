<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Contracts\AttributeContract;

class AttributeController extends BaseController
{
    protected $attributeRepository;

    public function __construct(AttributeContract $attributeRepository)
    {
        $this->attributeRepository = $attributeRepository;
    }

    public function index()
    {
        $attributes = $this->attributeRepository->listAttributes();

        $this->setPageTitle('Thuộc tính', 'Danh sách các thuộc tính');
        return view('admin.attributes.index', compact('attributes'));
    }

    public function create()
    {
        $this->setPageTitle('Thuộc tính', 'Tạo mới thuộc tính');
        return view('admin.attributes.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code'          =>  'required',
            'name'          =>  'required',
            'frontend_type' =>  'required'
        ]);

        $params = $request->except('_token');

        $attribute = $this->attributeRepository->createAttribute($params);

        if (!$attribute) {
            return $this->responseRedirectBack('Có lỗi xảy ra trong quá trình tạo mới thuộc tính.', 'error', true, true);
        }
        return $this->responseRedirect('admin.attributes.index', 'Tạo mới thành công', 'success', false, false);
    }

    public function edit($id)
    {
        $attribute = $this->attributeRepository->findAttributeById($id);

        $this->setPageTitle('Thuộc tính', 'Sửa thuộc tính : ' . $attribute->name);
        return view('admin.attributes.edit', compact('attribute'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'code'          =>  'required',
            'name'          =>  'required',
            'frontend_type' =>  'required'
        ]);

        $params = $request->except('_token');

        $attribute = $this->attributeRepository->updateAttribute($params);

        if (!$attribute) {
            return $this->responseRedirectBack('Có lỗi xảy ra trong quá trình cập nhật thuộc tính.', 'error', true, true);
        }
        return $this->responseRedirectBack('Cập nhật thuộc tính thành công', 'success', false, false);
    }

    public function delete($id)
    {
        $attribute = $this->attributeRepository->deleteAttribute($id);

        if (!$attribute) {
            return $this->responseRedirectBack('Có lỗi xảy ra trong quá trình xóa thuộc tính.', 'error', true, true);
        }
        return $this->responseRedirect('admin.attributes.index', 'Xóa thuộc tính thành công', 'success', false, false);
    }
}
