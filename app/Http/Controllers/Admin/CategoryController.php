<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Contracts\CategoryContract;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Admin
 */
class CategoryController extends BaseController
{
    /**
     * @var CategoryContract
     */
    protected $categoryRepository;

    /**
     * CategoryController constructor.
     * @param CategoryContract $categoryRepository
     */
    public function __construct(CategoryContract $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory\Illuminate\View\View
     */
    public function index()
    {
        $categories = $this->categoryRepository->listCategories();

        $this->setPageTitle('Danh mục', 'Danh sách tất cả danh mục');
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = $this->categoryRepository->treeList();

        $this->setPageTitle('Danh mục', 'Tạo danh mục mới');
        return view('admin.categories.create', compact('categories'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:191',
            'parent_id' =>  'required|not_in:0',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $params = $request->except('_token');

        $category = $this->categoryRepository->createCategory($params);

        if (!$category) {
            return $this->responseRedirectBack('Error occurred while creating category.', 'error', true, true);
        }
        return $this->responseRedirect('admin.categories.index', 'Category added successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetCategory = $this->categoryRepository->findCategoryById($id);
        $categories = $this->categoryRepository->treeList();

        $this->setPageTitle('Danh mục', 'Chỉnh sửa danh mục : ' . $targetCategory->name);
        return view('admin.categories.edit', compact('categories', 'targetCategory'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:191',
            'parent_id' =>  'required|not_in:0',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $params = $request->except('_token');

        $category = $this->categoryRepository->updateCategory($params);

        if (!$category) {
            return $this->responseRedirectBack('Có lỗi trong quá trình cập nhật.', 'error', true, true);
        }
        return $this->responseRedirectBack('Cập nhật danh mục thành công', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $category = $this->categoryRepository->deleteCategory($id);

        if (!$category) {
            return $this->responseRedirectBack('Có lỗi trong quá trình xóa danh mục.', 'error', true, true);
        }
        return $this->responseRedirect('admin.categories.index', 'Danh mục đã được xóa thành công', 'success', false, false);
    }
}
