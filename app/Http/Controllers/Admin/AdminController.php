<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Advertisement;

class AdminController extends Controller
{
    public function dashboard()
    {
        $now = now();

        // Grouped News status counts
        $newsStats = News::selectRaw("
        SUM(CASE WHEN status = 'published' THEN 1 ELSE 0 END) AS active_news,
        SUM(CASE WHEN status = 'draft' THEN 1 ELSE 0 END) AS pending_news,
        SUM(CASE WHEN status = 'unpublished' THEN 1 ELSE 0 END) AS unpublished_news
    ")->first();

        // Load only necessary fields for published news (avoid N+1)
        $newses = News::where('status', 'published')
            ->latest()
            ->limit(25) // limit results to speed up load
            ->get();

        // Category count
        $activeCategories = Category::where('status', 'active')->count();

        // Grouped Advertisement counts
        $adStats = Advertisement::selectRaw("
        SUM(CASE WHEN status = 'approved' THEN 1 ELSE 0 END) AS active_advertisements,
        SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) AS pending_advertisements,
        SUM(CASE WHEN end_date < ? OR status = 'expired' THEN 1 ELSE 0 END) AS expired_advertisements
    ", [$now])->first();

        $data = [
            'newses'                 => $newses,
            'active_news'            => $newsStats->active_news,
            'pending_news'           => $newsStats->pending_news,
            'unpublished_news'       => $newsStats->unpublished_news,
            'active_categories'      => $activeCategories,
            'active_advertisements'  => $adStats->active_advertisements,
            'pending_advertisements' => $adStats->pending_advertisements,
            'expired_advertisements' => $adStats->expired_advertisements,
        ];

        return view('admin.dashboard', $data);
    }
}
