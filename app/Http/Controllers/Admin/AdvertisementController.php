<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Advertisement;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['advertisements'] = Advertisement::latest('id')->get();
        return view('admin.pages.advertisement.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.advertisement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $validator = Validator::make($request->all(), [
                'title'             => 'nullable|string|max:255',
                'ad_type'           => 'required|in:image,html,video,script',
                'image_path'        => 'nullable|required_if:ad_type,image|string|max:1000',
                'video_path'        => 'nullable|required_if:ad_type,video|string|max:1000',
                'html_code'         => 'nullable|required_if:ad_type,html|required_if:ad_type,script|string',
                'link'              => 'nullable|url|max:1000',
                'target_blank'      => 'boolean',
                'position'          => 'nullable|string|max:255',
                'price'             => 'nullable|numeric|min:0',
                'priority'          => 'nullable|integer|min:0',
                'start_date'        => 'nullable|date',
                'end_date'          => 'nullable|date|after_or_equal:start_date',
                'status'            => 'required|in:pending,approved,rejected,expired',
                'is_active'         => 'boolean',
                'company_name'      => 'nullable|string|max:255',
                'company_website'   => 'nullable|url|max:1000',
                'user_id'           => 'nullable|exists:users,id',
            ], [
                'ad_type.required'        => 'Ad type is required.',
                'image_path.required_if'  => 'Image path is required for image ads.',
                'video_path.required_if'  => 'Video path is required for video ads.',
                'html_code.required_if'   => 'HTML code is required for HTML or script ads.',
                'link.url'                => 'The ad link must be a valid URL.',
                'company_website.url'     => 'The company website must be a valid URL.',
                'end_date.after_or_equal' => 'End date must be after or equal to start date.',
            ]);

            if ($validator->fails()) {
                foreach ($validator->messages()->all() as $message) {
                    Session::flash('error', $message);
                }
                return redirect()->back()->withInput();
            }

            // Optional: generate a code like AD-280524-001
            $advertisement = Advertisement::create([
                'title'           => $request->input('title'),
                'ad_type'         => $request->input('ad_type'),
                'image_path'      => $request->input('ad_type') === 'image' ? $request->input('image_path') : null,
                'video_path'      => $request->input('ad_type') === 'video' ? $request->input('video_path') : null,
                'html_code'       => in_array($request->input('ad_type'), ['html', 'script']) ? $request->input('html_code') : null,
                'link'            => $request->input('link'),
                'target_blank'    => $request->input('target_blank', false),
                'position'        => $request->input('position'),
                'price'           => $request->input('price', 0.00),
                'priority'        => $request->input('priority', 0),
                'start_date'      => $request->input('start_date', now()),
                'end_date'        => $request->input('end_date'),
                'status'          => $request->input('status'),
                // 'is_active'       => $request->input('is_active', true),
                'company_name'    => $request->input('company_name'),
                'company_website' => $request->input('company_website'),
                'user_id'         => $request->input('user_id'),
            ]);
            DB::commit();
            Session::flash('success', 'Advertisement created successfully.');
            return redirect()->route('admin.advertisement.index')->with('success', 'Advertisement created successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            // Return back with error message
            return redirect()->back()->withInput()->with('error', 'An error occurred while creating the Advertisement: ' . $e->getMessage());
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
        $advertisement = Advertisement::findOrFail($id);
        return view('admin.pages.advertisement.edit', compact('advertisement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Advertisement $advertisement)
    {
        DB::beginTransaction();

        try {
            $validator = Validator::make($request->all(), [
                'title'             => 'nullable|string|max:255',
                'ad_type'           => 'required|in:image,html,video,script',
                'image_path'        => 'nullable|required_if:ad_type,image|string|max:1000',
                'video_path'        => 'nullable|required_if:ad_type,video|string|max:1000',
                'html_code'         => 'nullable|required_if:ad_type,html|required_if:ad_type,script|string',
                'link'              => 'nullable|url|max:1000',
                'target_blank'      => 'boolean',
                'position'          => 'nullable|string|max:255',
                'price'             => 'nullable|numeric|min:0',
                'priority'          => 'nullable|integer|min:0',
                'start_date'        => 'nullable|date|after_or_equal:today',
                'end_date'          => 'nullable|date|after_or_equal:start_date',
                'status'            => 'required|in:pending,approved,rejected,expired',
                'is_active'         => 'boolean',
                'company_name'      => 'nullable|string|max:255',
                'company_website'   => 'nullable|url|max:1000',
                'user_id'           => 'nullable|exists:users,id',
            ], [
                'ad_type.required'        => 'Ad type is required.',
                'image_path.required_if'  => 'Image path is required for image ads.',
                'video_path.required_if'  => 'Video path is required for video ads.',
                'html_code.required_if'   => 'HTML code is required for HTML or script ads.',
                'link.url'                => 'The ad link must be a valid URL.',
                'company_website.url'     => 'The company website must be a valid URL.',
                'end_date.after_or_equal' => 'End date must be after or equal to start date.',
                'start_date.after_or_equal' => 'Start date must be today or later.',
            ]);

            if ($validator->fails()) {
                foreach ($validator->messages()->all() as $message) {
                    Session::flash('error', $message);
                }
                return redirect()->back()->withInput();
            }

            // Update the advertisement
            $advertisement->update([
                'title'           => $request->input('title'),
                'ad_type'         => $request->input('ad_type'),
                'image_path'      => $request->input('ad_type') === 'image' ? $request->input('image_path') : null,
                'video_path'      => $request->input('ad_type') === 'video' ? $request->input('video_path') : null,
                'html_code'       => in_array($request->input('ad_type'), ['html', 'script']) ? $request->input('html_code') : null,
                'link'            => $request->input('link'),
                'target_blank'    => $request->input('target_blank', false),
                'position'        => $request->input('position'),
                'price'           => $request->input('price', 0.00),
                'priority'        => $request->input('priority', 0),
                'start_date'      => $request->input('start_date', now()),
                'end_date'        => $request->input('end_date'),
                'status'          => $request->input('status'),
                'is_active'       => $request->input('is_active', true),
                'company_name'    => $request->input('company_name'),
                'company_website' => $request->input('company_website'),
                'user_id'         => $request->input('user_id'),
            ]);

            DB::commit();
            Session::flash('success', 'Advertisement updated successfully.');
            return redirect()->route('admin.advertisement.index')->with('success', 'Advertisement updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', 'An error occurred while updating the Advertisement: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Advertisement $advertisement)
    {

        $advertisement->delete();
    }
}
