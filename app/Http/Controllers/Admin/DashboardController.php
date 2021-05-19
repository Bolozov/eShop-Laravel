<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class DashboardController extends Controller
{
    public function index()
    {
        $usersCount = User::count('id');
        $ordersCount = Order::count('id');
        $productsCount = Product::count('id');
        $categoriesCount = Category::count('id');

        $dataOrders = Order::selectRaw('
        count(*) as  data,
        month(created_at) as month,
        monthname(created_at) as month_name
        ')
            ->whereYear('created_at', now()->year)
            ->groupBy('month', 'month_name')
            ->orderBy('month', 'asc')
            ->get();

        $chart = (new LarapexChart)->areaChart()
            ->addData('Commandes', $dataOrders->pluck('data')->toArray())
            ->setXAxis($dataOrders->pluck('month_name')->toArray());

        $dataNewUsers = User::selectRaw('
            count(*) as  data,
            month(created_at) as month,
            monthname(created_at) as month_name
            ')
            ->whereYear('created_at', now()->year)
            ->groupBy('month', 'month_name')
            ->orderBy('month', 'asc')
            ->get();

        $newUsersChart = (new LarapexChart)->barChart()
            ->addData('Nombre de client' , $dataNewUsers->pluck('data')->toArray() )
            ->setXAxis($dataNewUsers->pluck('month_name')->toArray());

        return view('admin.dashboard.index', compact('usersCount', 'ordersCount', 'productsCount', 'categoriesCount', 'chart' , 'newUsersChart'));
    }
}
