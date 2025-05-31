<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Models\News;
use App\Models\Epaper;
use App\Models\Contact;
use App\Models\Setting;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\Http\Resources\NewsResource;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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
                    ->orWhere('sub_category_id', $category->id);
            })
                ->with(['images'])
                // ->with(['category', 'subCategory', 'images'])
                ->where('status', 'published')
                ->orderByDesc('published_at')
                ->get(); // Optional: ->paginate(10)

            return response()->json([
                'success'  => true,
                'message'  => 'News found for category: ' . $category->name,
                'category' => $this->transformCategory($category),
                // 'category' => $category,
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
            if ($news->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No breaking news found.',
                ], 404);
            }
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

    public function featuredNews()
    {
        try {
            $news = News::where('is_featured', 1)
                ->where('status', 'published')
                ->orderByDesc('published_at')
                ->get();
            if ($news->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No featured news found.',
                ], 404);
            }
            return response()->json([
                'success' => true,
                'message' => 'featured news retrieved successfully.',
                'data'    => NewsResource::collection($news),
            ], 200);
        } catch (\Exception $e) {
            Log::error('Failed to fetch featured news: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve featured news.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
    public function sliderNews()
    {
        try {
            $news = News::where('show_in_slider', 1)
                ->where('status', 'published')
                ->orderByDesc('published_at')
                ->get();

            if ($news->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No slider news found.',
                ], 404);
            }
            return response()->json([
                'success' => true,
                'message' => 'Slider news retrieved successfully.',
                'data'    => NewsResource::collection($news),
            ], 200);
        } catch (\Exception $e) {
            Log::error('Failed to fetch slider news: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve slider news.',
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
            if ($news->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No latest news found.',
                ], 404);
            }
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

            if ($news->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No most viewed news found.',
                ], 404);
            }
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

            if ($news->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No trending news found.',
                ], 404);
            }
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
            if ($news->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No news found for the given search query.',
                ], 404);
            }
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

    public function searchSuggestions(Request $request)
    {
        $query = $request->input('query');

        if (empty($query)) {
            return response()->json([
                'success' => false,
                'message' => 'Search query cannot be empty.',
            ], 400);
        }

        try {
            // Get suggestions from news titles and summaries
            $suggestions = News::where('status', 'published')
                ->where(function ($q) use ($query) {
                    $q->where('title', 'like', '%' . $query . '%')
                        ->orWhere('bangla_title', 'like', '%' . $query . '%')
                        ->orWhere('summary', 'like', '%' . $query . '%');
                })
                ->select('title', 'slug')
                // ->limit(10)
                ->get();
            if ($suggestions->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No search suggestions found for the given query.',
                ], 404);
            }
            return response()->json([
                'success' => true,
                'message' => 'Search suggestions retrieved successfully.',
                'data'    => $suggestions,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Failed to fetch search suggestions: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve search suggestions.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function advertisements()
    {
        try {
            $advertisements = \App\Models\Advertisement::where('status', 'approved')
                ->where('start_date', '<=', now())
                ->where(function ($query) {
                    $query->whereNull('end_date')
                        ->orWhere('end_date', '>=', now());
                })->latest()
                ->get();

            if ($advertisements->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No advertisements found.',
                ], 404);
            }
            $data = $advertisements->map(function ($ad) {
                return [
                    'id'              => $ad->id,
                    'title'           => $ad->title,
                    'ad_type'         => $ad->ad_type,
                    'image_path'      => $ad->image_path ?? null,
                    'video_path'      => $ad->video_path,
                    'html_code'       => $ad->html_code,
                    'link'            => $ad->link,
                    'target_blank'    => $ad->target_blank,
                    'position'        => $ad->position,
                    // 'price'        => $ad->price,
                    'priority'        => $ad->priority,
                    'start_date'      => $ad->start_date,
                    'end_date'        => $ad->end_date,
                    'status'          => $ad->status,
                    'company_name'    => $ad->company_name,
                    'company_website' => $ad->company_website,
                    'availability'    => ($ad->start_date <= now() && (!$ad->end_date || $ad->end_date >= now())) ? 'available' : 'expired',
                ];
            });
            return response()->json([
                'success' => true,
                'message' => 'Advertisements retrieved successfully.',
                'data'    => $data,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Failed to fetch advertisements: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve advertisements.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
    public function ePaper()
    {
        try {
            $epapers = Epaper::where('is_active', true)
                ->latest()
                ->get();

            if ($epapers->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No E-Paper found.',
                ], 404);
            }

            $data = $epapers->map(function ($epaper) {
                return [
                    'id'                 => $epaper->id,
                    'epaper_name'        => $epaper->epaper_name,
                    'slug'               => $epaper->slug,
                    'epaper_title'       => $epaper->epaper_title,
                    'post_date'          => $epaper->post_date,
                    'epaper_image'       => $epaper->epaper_image ?? null,
                    'epaper_image_alt'   => $epaper->epaper_image_alt,
                    'language'           => $epaper->language,
                    'page_number'        => $epaper->page_number,
                    'total_pages'        => $epaper->total_pages,
                    'epaper_pdf_url'     => $epaper->epaper_pdf_url ?? null,
                    'tags'               => json_decode($epaper->tags, true),
                    'published_by'       => $epaper->published_by,
                    'region'             => $epaper->region,
                ];
            });

            return response()->json([
                'success'  => true,
                'message'  => 'ePapers retrieved successfully.',
                'data'     => $data,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Failed to fetch ePapers: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve ePapers.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
    public function ePaperDetails($slug)
    {
        try {
            $epaper = Epaper::where('slug', $slug)
                ->where('is_active', true)
                ->first();

            if (!$epaper) {
                return response()->json([
                    'success' => false,
                    'message' => 'E-Paper not found.',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'E-Paper details retrieved successfully.',
                'data'    => [
                    'id'                 => $epaper->id,
                    'epaper_name'        => $epaper->epaper_name,
                    'slug'               => $epaper->slug,
                    'epaper_title'       => $epaper->epaper_title,
                    'post_date'          => $epaper->post_date,
                    'epaper_image'       => $epaper->epaper_image ?? null,
                    'epaper_image_alt'   => $epaper->epaper_image_alt,
                    'language'           => $epaper->language,
                    'page_number'        => $epaper->page_number,
                    'total_pages'        => $epaper->total_pages,
                    'epaper_pdf_url'     => $epaper->epaper_pdf_url ?? null,
                    'tags'               => json_decode($epaper->tags, true),
                    'published_by'       => $epaper->published_by,
                    'region'             => $epaper->region,
                ],
            ], 200);
        } catch (\Exception $e) {
            Log::error('Failed to fetch ePaper details: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve ePaper details.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
    public function contactStore(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:150',
            'email' => 'required|email|max:150',
            'phone' => 'nullable|string|max:20',
            'subject' => 'nullable|string',
            'message' => 'nullable|string',
            'ip_address' => 'nullable|ip|max:100',
            // 'g-recaptcha-response' => ['required', new Recaptcha],
        ], [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than :max characters.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'The email may not be greater than :max characters.',
            'phone.string' => 'The phone must be a string.',
            'phone.max' => 'The phone may not be greater than :max characters.',
            'phone.regex' => 'The phone field must contain only numeric characters and must be proper number.',
            'subject.string' => 'The subject must be a string.',
            'message.string' => 'The message must be a string.',
            'ip_address.ip' => 'Please enter a valid IP address.',
            'ip_address.max' => 'The IP address may not be greater than :max characters.',
            // 'g-recaptcha-response.required' => 'The reCAPTCHA field is required.',
        ]);

        if ($request->filled('phone')) {
            $validator->sometimes('phone', 'regex:/^[0-9]+$/i', function ($input) {
                return $input->phone;
            });
        }

        if ($validator->fails()) {
            foreach ($validator->messages()->all() as $message) {
                Session::flash('error', $message);
                // Toastr::error($message, 'Failed', ['timeOut' => 3000]);
            }
            return redirect()->back()->withInput();
        }



        try {
            $typePrefix = 'MSG';
            $today = date('dmy');
            $lastCode = Contact::where('code', 'like', $typePrefix . '-' . $today . '%')->orderBy('id', 'desc')->first();

            $newNumber = $lastCode ? (int) explode('-', $lastCode->code)[2] + 1 : 1;
            $code = $typePrefix . '-' . $today . '-' . $newNumber;

            Contact::create([
                'code'       => $code,
                'name'       => $request->name,
                'email'      => $request->email,
                'phone'      => $request->phone,
                'subject'    => $request->subject,
                'message'    => $request->message,
                'ip_address' => request()->ip(),
                'status'     => 'pending',
                'priority'   => 'normal',
                'call'       => $request->call,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Your message has been sent successfully.',
            ], 200);
        } catch (\Exception $e) {
            Log::error('Failed to store contact message: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to send your message.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
