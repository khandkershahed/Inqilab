<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Models\News;
use App\Models\Setting;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\Http\Resources\NewsResource;

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
    public function siteInformations(): JsonResponse
    {
        try {
            // Assuming there's only one row in the settings table
            $setting = Setting::first();

            if (!$setting) {
                return response()->json([
                    'success' => false,
                    'message' => 'Settings not found.',
                    'data'    => null
                ], 404);
            }

            $data = [
                // Branding
                'website_name'              => $setting->website_name,
                'site_title'                => $setting->site_title,
                'site_motto'                => $setting->site_motto,
                'site_logo_white'           => $setting->site_logo_white ? URL::to('storage/' . $setting->site_logo_white)       : null,
                'site_logo_black'           => $setting->site_logo_black ? URL::to('storage/' . $setting->site_logo_black)       : null,
                'site_favicon'              => $setting->site_favicon ? URL::to('storage/' . $setting->site_favicon)          : null,
                'login_background_image'    => $setting->login_background_image ? URL::to('storage/' . $setting->login_background_image) : null,

                // Contact Info
                'primary_email'             => $setting->primary_email,
                'support_email'             => $setting->support_email,
                'info_email'                => $setting->info_email,
                'news_email'                => $setting->news_email,
                'primary_phone'             => $setting->primary_phone,
                'fax'                       => $setting->fax,
                'alternative_phone'         => $setting->alternative_phone,
                'whatsapp_number'           => $setting->whatsapp_number,

                // Address
                'address_one'               => $setting->address_one,
                'address_two'               => $setting->address_two,

                // Timezone & Language
                'default_language'          => $setting->default_language,
                'default_currency'          => $setting->default_currency,
                'system_timezone'           => $setting->system_timezone,

                // SEO & Analytics
                'site_url'                  => $setting->site_url,
                'meta_title'                => $setting->meta_title,
                'meta_keyword'              => $setting->meta_keyword,
                'meta_tags'                 => $setting->meta_tags,
                'meta_description'          => $setting->meta_description,
                'google_analytics'          => $setting->google_analytics,
                'google_adsense'            => $setting->google_adsense,
                'facebook_pixel_id'         => $setting->facebook_pixel_id,
                'og_image'                  => $setting->og_image ? URL::to('storage/' . $setting->og_image)              : null,
                'og_title'                  => $setting->og_title,
                'og_description'            => $setting->og_description,
                'canonical_url'             => $setting->canonical_url,

                // Copyright
                'copyright_title'           => $setting->copyright_title,
                'copyright_url'             => $setting->copyright_url,

                // Social URLs
                'facebook_url'              => $setting->facebook_url,
                'instagram_url'             => $setting->instagram_url,
                'linkedin_url'              => $setting->linkedin_url,
                'whatsapp_url'              => $setting->whatsapp_url,
                'twitter_url'               => $setting->twitter_url,
                'youtube_url'               => $setting->youtube_url,
                'pinterest_url'             => $setting->pinterest_url,
                'reddit_url'                => $setting->reddit_url,
                'tumblr_url'                => $setting->tumblr_url,
                'tiktok_url'                => $setting->tiktok_url,
                'website_url'               => $setting->website_url,

                // // Feature Toggles
                // 'maintenance_mode'          => (bool) $setting->maintenance_mode,
                // 'enable_user_registration'  => (bool) $setting->enable_user_registration,
                // 'enable_email_verification' => (bool) $setting->enable_email_verification,
                // 'enable_api_access'         => (bool) $setting->enable_api_access,
                // 'enable_multilanguage'      => (bool) $setting->enable_multilanguage,
                // 'is_demo'                   => (bool) $setting->is_demo,

                // Business Info
                'company_name'              => $setting->company_name,
                // 'minimum_order_amount'      => $setting->minimum_order_amount,

                // Business Hours
                'business_hours'            => json_decode($setting->business_hours, true),

                // // Email Config
                // 'mail_driver'               => $setting->mail_driver,
                // 'mail_host'                 => $setting->mail_host,
                // 'mail_port'                 => $setting->mail_port,
                // 'mail_username'             => $setting->mail_username,
                // 'mail_password'             => $setting->mail_password,
                // 'mail_encryption'           => $setting->mail_encryption,
                // 'mail_from_address'         => $setting->mail_from_address,
                // 'mail_from_name'            => $setting->mail_from_name,

                // // Security
                // 'captcha_enabled'           => (bool) $setting->captcha_enabled,
                // 'captcha_site_key'          => $setting->captcha_site_key,
                // 'captcha_secret_key'        => $setting->captcha_secret_key,
                // 'cookie_consent_enabled'    => (bool) $setting->cookie_consent_enabled,
                // 'cookie_consent_text'       => $setting->cookie_consent_text,
                // 'privacy_policy_url'        => $setting->privacy_policy_url,
                // 'terms_conditions_url'      => $setting->terms_conditions_url,

                // Advanced
                'theme_color'               => $setting->theme_color,
                'dark_mode'                 => (bool) $setting->dark_mode,
                'custom_css'                => $setting->custom_css,
                'custom_js'                 => $setting->custom_js,

                // Custom Settings
                'custom_settings'           => json_decode($setting->custom_settings, true),

                // Timestamps
                // 'created_at'                => $setting->created_at,
                // 'updated_at'                => $setting->updated_at,
            ];

            return response()->json([
                'success' => true,
                'message' => 'Site information retrieved successfully.',
                'data' => $data,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving site information.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function categoryWiseNews($slug)
    {
        try {
            // Get category by slug
            $category = Category::where('slug', $slug)->first();

            if (!$category) {
                return response()->json([
                    'success' => false,
                    'message' => 'Category not found.',
                ], 404);
            }

            // Fetch news where this category is used as category, subcategory or sub-subcategory
            $news = News::where(function ($query) use ($category) {
                $query->where('category_id', $category->id)
                    ->orWhere('sub_category_id', $category->id)
                    ->orWhere('sub_sub_category_id', $category->id);
            })
                ->with(['images'])
                // ->with(['category', 'subCategory', 'images'])
                ->where('status', 'published')
                ->orderByDesc('published_at')
                ->get(); // Optional: ->paginate(10)

            return response()->json([
                'success'  => true,
                'message'  => 'News found for category: ' . $category->name,
                'category' => $category,
                'data'     => NewsResource::collection($news),
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to load category-wise news: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while retrieving news.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function breakingNews()
    {
        try {
            $news = News::where('is_breaking', 1)
                ->where('status', 'published')
                ->orderByDesc('published_at')
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Breaking news retrieved successfully.',
                'data'    => NewsResource::collection($news),
            ], 200);
        } catch (\Exception $e) {
            Log::error('Failed to fetch breaking news: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve breaking news.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function spotlightNews()
    {
        try {
            $news = News::where('is_featured', 1)
                ->where('status', 'published')
                ->orderByDesc('published_at')
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Spotlight news retrieved successfully.',
                'data'    => NewsResource::collection($news),
            ], 200);
        } catch (\Exception $e) {
            Log::error('Failed to fetch spotlight news: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve spotlight news.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function latestNews()
    {
        try {
            $news = News::where('status', 'published')
                ->orderByDesc('published_at')
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Latest news retrieved successfully.',
                'data'    => NewsResource::collection($news),
            ], 200);
        } catch (\Exception $e) {
            Log::error('Failed to fetch latest news: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve latest news.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function viewedNews()
    {
        try {
            $news = News::where('is_most_read', 1)
                ->where('status', 'published')
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Most viewed news retrieved successfully.',
                'data'    => NewsResource::collection($news),
            ], 200);
        } catch (\Exception $e) {
            Log::error('Failed to fetch most viewed news: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve most viewed news.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function trendingNews()
    {
        try {
            $news = News::where('is_trending', 1)
                ->where('status', 'published')
                ->orderByDesc('published_at')
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Trending news retrieved successfully.',
                'data'    => NewsResource::collection($news),
            ], 200);
        } catch (\Exception $e) {
            Log::error('Failed to fetch trending news: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve trending news.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function newsDetails($slug)
    {
        try {
            $news = News::where('slug', $slug)
                ->with(['images', 'category', 'subCategory'])
                ->where('status', 'published')
                ->first();

            if (!$news) {
                return response()->json([
                    'success' => false,
                    'message' => 'News not found.',
                ], 404);
            }

            $relatedNews = News::where('category_id', $news->category_id)
                ->orWhere('sub_category_id', $news->sub_category_id)
                ->where('slug', '!=', $slug)
                ->where('status', 'published')
                ->orderByDesc('published_at')
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'News details retrieved successfully.',
                'news_details' => new NewsResource($news),
                'related_news' => NewsResource::collection($relatedNews),
            ], 200);
        } catch (\Exception $e) {
            Log::error('Failed to fetch news details: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve news details.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
    public function globalSearch(Request $request)
    {
        $query = $request->input('query');

        if (empty($query)) {
            return response()->json([
                'success' => false,
                'message' => 'Search query cannot be empty.',
            ], 400);
        }

        try {
            // Search in news titles, summaries, and content
            $news = News::where('status', 'published')
                ->where(function ($q) use ($query) {
                    $q->where('title', 'like', '%' . $query . '%')
                        ->orWhere('bangla_title', 'like', '%' . $query . '%')
                        ->orWhere('summary', 'like', '%' . $query . '%')
                        ->orWhere('content', 'like', '%' . $query . '%');
                })
                ->with(['images'])
                ->orderByDesc('published_at')
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Search results retrieved successfully.',
                'data'    => NewsResource::collection($news),
            ], 200);
        } catch (\Exception $e) {
            Log::error('Failed to perform search: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to perform search.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
