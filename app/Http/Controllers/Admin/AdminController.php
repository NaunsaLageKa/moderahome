<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
            'total_orders' => Order::count(),
            'total_users' => User::count(),
            'new_orders' => Order::where('status', 'pending')->orWhere('status', 'processing')->count(),
            'total_revenue' => Order::where('status', '!=', 'cancelled')->sum('total'),
            'pending_reviews' => Review::where('is_approved', false)->count(),
        ];

        // Calculate revenue change (simplified - comparing this week to last week)
        $thisWeekRevenue = Order::where('status', '!=', 'cancelled')
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->sum('total');
        
        $lastWeekRevenue = Order::where('status', '!=', 'cancelled')
            ->whereBetween('created_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()])
            ->sum('total');
        
        $revenueChange = $lastWeekRevenue > 0 
            ? (($thisWeekRevenue - $lastWeekRevenue) / $lastWeekRevenue) * 100 
            : 0;

        // Weekly trend data (last 7 days)
        $weeklyTrend = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $weeklyTrend[] = [
                'day' => $date->format('D'),
                'revenue' => Order::where('status', '!=', 'cancelled')
                    ->whereDate('created_at', $date->format('Y-m-d'))
                    ->sum('total')
            ];
        }

        $recent_orders = Order::with('user')->latest()->take(5)->get();
        $low_stock_products = Product::where('stock', '<=', 5)->where('stock', '>', 0)->with('category')->take(2)->get();
        $out_of_stock_products = Product::where('stock', 0)->with('category')->take(2)->get();

        return view('admin.dashboard', compact('stats', 'recent_orders', 'low_stock_products', 'out_of_stock_products', 'revenueChange', 'weeklyTrend'));
    }
}
