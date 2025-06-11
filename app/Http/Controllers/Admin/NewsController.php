<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\NewsRequest;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private function generateUniqueSlug()
    {
        do {
            $slug = Str::lower(Str::random(10)); // e.g., z9pa8mpbt3
        } while (News::where('slug', $slug)->exists());

        return $slug;
    }


    public function index()
    {
        $data = [
            'newses' => News::with('category', 'subCategory')->latest('id')->get(),
        ];
        return view('admin.pages.news.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'categories'    => Category::whereNull('parent_id')->get(),
            'subCategories' => Category::whereNotNull('parent_id')->get(),
        ];
        return view('admin.pages.news.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewsRequest $request)
    {
        DB::beginTransaction();

        try {
            // Initialize variables to store file paths
            // $files = [
            //     'thumbnail'     => $request->file('thumbnail'),
            //     'banner_image'  => $request->file('banner_image'),
            // ];
            // $uploadedFiles = [];

            // foreach ($files as $key => $file) {
            //     if (!empty($file)) {
            //         $filePath = 'news/' . $key;
            //         $uploadResult = customUpload($file, $filePath);

            //         if ($uploadResult['status'] === 0) {
            //             return redirect()->back()->with('error', $uploadResult['error_message']);
            //         }

            //         $uploadedFiles[$key] = $uploadResult;
            //     } else {
            //         $uploadedFiles[$key] = ['status' => 0];
            //     }
            // }

            // Handle boolean flags
            $flags = [
                'is_featured',
                'is_most_read',
                'is_breaking',
                'show_on_homepage',
                'show_in_slider',
                'is_trending'
            ];

            $flagData = [];
            foreach ($flags as $flag) {
                $flagData[$flag] = $request->has($flag) ? 1 : 0;
            }

            // Create the news record
            $news = News::create([
                'title'                 => $request->bangla_title,
                'bangla_title'          => $request->bangla_title,
                'slug'                  => $this->generateUniqueSlug(),
                'tags'                  => $request->tags,
                'summary'               => $request->summary,
                'bangla_summary'        => $request->bangla_summary,
                'content'               => $request->content,
                'bangla_content'        => $request->bangla_content,
                'video_url'             => $request->video_url,
                'thumbnail'             => $request->thumbnail,
                'banner_image'          => $request->banner_image,
                // 'thumbnail'             => $uploadedFiles['thumbnail']['status'] === 1 ? $uploadedFiles['thumbnail']['file_path'] : null,
                // 'banner_image'          => $uploadedFiles['banner_image']['status'] === 1 ? $uploadedFiles['banner_image']['file_path'] : null,
                'meta_title'            => $request->meta_title,
                'meta_description'      => $request->meta_description,
                'meta_keywords'         => $request->meta_keywords,
                'category_id'           => $request->category_id,
                'sub_category_id'       => $request->sub_category_id,
                'author_id'             => $request->author_id,
                'status'                => $request->status,
                'published_at'          => $request->status === 'published' ? now() : null,
                'view_count'            => 0,
                'share_count'           => 0,
                'comment_count'         => 0,
                'created_by'            => Auth::guard('admin')->id(),
                'updated_by'            => Auth::guard('admin')->id(),
            ] + $flagData);

            DB::commit();

            return redirect()->route('admin.news.index')->with('success', 'News has been created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            if (isset($uploadedFiles['thumbnail']['file_path'])) {
                Storage::disk('public')->delete($uploadedFiles['thumbnail']['file_path']);
            }

            if (isset($uploadedFiles['banner_image']['file_path'])) {
                Storage::disk('public')->delete($uploadedFiles['banner_image']['file_path']);
            }

            // Optional: log the error
            // Log::error($e);

            return back()->withInput()->with('error', 'Failed to create news: ' . $e->getMessage());
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [
            'news'          => News::findOrFail($id),
            'categories'    => Category::whereNull('parent_id')->get(),
            'subCategories' => Category::whereNotNull('parent_id')->get(),
        ];
        return view('admin.pages.news.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NewsRequest $request, $id)
    {
        $news = News::findOrFail($id);
        DB::beginTransaction();
        try {

            $newThumbnail = $request->input('thumbnail');
            $newBannerImage = $request->input('banner_image');

            // Helper: Delete file from full URL
            $deleteFileFromUrl = function ($url) {
                $relativePath = ltrim(Str::replaceFirst(url('/'), '', $url), '/'); // clean up
                $filePath = public_path($relativePath);
                // dd($filePath); // Debugging line to check file path
                if (File::exists($filePath)) {
                    File::delete($filePath);
                } else {
                    Log::warning('File not found for deletion', [
                        'url' => $url,
                        'resolved_path' => $filePath
                    ]);
                }
            };

            // If thumbnail is changed, delete old one
            if ($newThumbnail != null && $newThumbnail !== $news->thumbnail) {
                $deleteFileFromUrl($news->thumbnail);
            }

            // If banner image is changed, delete old one
            if ($newBannerImage != null && $newBannerImage !== $news->banner_image) {
                $deleteFileFromUrl($news->banner_image);
            }

            // Handle boolean flags
            $flags = [
                'is_featured',
                'is_most_read',
                'is_breaking',
                'show_on_homepage',
                'show_in_slider',
                'is_trending'
            ];

            $flagData = [];
            foreach ($flags as $flag) {
                $flagData[$flag] = $request->has($flag) ? 1 : 0;
            }

            // Update News data
            $news->update([
                'title'                 => $request->title,
                'bangla_title'          => $request->bangla_title,
                'tags'                  => $request->tags,
                'summary'               => $request->summary,
                'bangla_summary'        => $request->bangla_summary,
                'content'               => $request->content,
                'bangla_content'        => $request->bangla_content,
                'video_url'             => $request->video_url,
                'thumbnail'             => $request->thumbnail ?? $news->thumbnail,
                'banner_image'          => $request->banner_image ?? $news->banner_image,
                // 'thumbnail'             => $uploadedFiles['thumbnail'],
                // 'banner_image'          => $uploadedFiles['banner_image'],
                'meta_title'            => $request->meta_title,
                'meta_description'      => $request->meta_description,
                'meta_keywords'         => $request->meta_keywords,
                'category_id'           => $request->category_id,
                'sub_category_id'       => $request->sub_category_id,
                'author_id'             => $request->author_id,
                'status'                => $request->status,
                'published_at'          => $request->status === 'published' && $news->published_at === null ? now() : $news->published_at,
                'updated_by'            => Auth::guard('admin')->id(),
            ] + $flagData);

            DB::commit();

            return redirect()->route('admin.news.index')->with('success', 'News has been updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            // If any new file was uploaded, delete it since the update failed

            return back()->withInput()->with('error', 'Failed to update news: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news = News::findOrFail($id);

        // Delete thumbnail and banner image if they exist
        // Helper to delete file from full URL
        $deleteFileFromUrl = function ($url) {
            $relativePath = ltrim(Str::replaceFirst(url('/'), '', $url), '/'); // clean up
                $filePath = public_path($relativePath);
                // dd($filePath); // Debugging line to check file path
                if (File::exists($filePath)) {
                    File::delete($filePath);
                } else {
                    Log::warning('File not found for deletion', [
                        'url' => $url,
                        'resolved_path' => $filePath
                    ]);
                }
        };

        // Delete thumbnail
        if ($news->thumbnail) {
            $deleteFileFromUrl($news->thumbnail);
        }

        // Delete banner image
        if ($news->banner_image) {
            $deleteFileFromUrl($news->banner_image);
        }

        $news->delete();
    }
}


// Initialize updated file paths
            // $files = [
            //     'thumbnail'     => $request->file('thumbnail'),
            //     'banner_image'  => $request->file('banner_image'),
            // ];
            // $uploadedFiles = [];
            // foreach ($files as $key => $file) {
            //     if (!empty($file)) {
            //         $uploadPath = 'news/' . $key;
            //         $uploadResult = customUpload($file, $uploadPath);
            //         if ($uploadResult['status'] === 0) {
            //             return redirect()->back()->with('error', $uploadResult['error_message']);
            //         }
            //         // Delete the old file if exists
            //         if (!empty($news->$key)) {
            //             Storage::disk('public')->delete($news->$key);
            //         }
            //         $uploadedFiles[$key] = $uploadResult['file_path'];
            //     } else {
            //         $uploadedFiles[$key] = $news->$key; // Keep existing path if no new upload
            //     }
            // }
