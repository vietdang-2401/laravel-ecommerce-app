<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\OrderContract;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class OrderController extends BaseController
{
    protected $orderRepository;

    public function __construct(OrderContract $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        $orders = $this->orderRepository->listOrders();
        $this->setPageTitle('Đơn hàng', 'Danh sách các đơn hàng');
        return view('admin.orders.index', compact('orders'));
    }

    public function show($orderNumber)
    {
        $order = $this->orderRepository->findOrderByNumber($orderNumber);

        $this->setPageTitle('Chi tiết đơn hàng', $orderNumber);
        return view('admin.orders.show', compact('order'));
    }
}
