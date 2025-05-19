<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class HomeApiController extends Controller
{
    public function allCategories()
    {
        try {
            // Load top-level categories with recursive children
            $categories = Category::with('children')
                ->whereNull('parent_id')
                ->where('status', 'active')
                ->orderBy('serial')
                ->get();

            // Transform data for API response
            $data = $categories->map(fn($cat) => $this->transformCategory($cat));

            return response()->json([
                'success' => true,
                'message' => 'All categories retrieved successfully.',
                'data'    => $data,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Failed to fetch categories: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve categories.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Recursively transform category with children
     *
     * @param  \App\Models\Category  $category
     * @return array
     */
    private function transformCategory($category)
    {
        return [
            'id'           => $category->id,
            'name'         => $category->name,
            'bangla_name'  => $category->bangla_name,
            'slug'         => $category->slug,
            'code'         => $category->code,
            'status'       => $category->status,
            'logo'         => $category->logo ? url('storage/' . $category->logo) : null,
            'image'        => $category->image ? url('storage/' . $category->image) : null,
            'banner_image' => $category->banner_image ? url('storage/' . $category->banner_image) : null,
            'children'     => $category->children->map(fn($child) => $this->transformCategory($child)),
        ];
    }
}
