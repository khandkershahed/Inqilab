<?php

namespace App\Http\Controllers\Admin;

use App\Models\Epaper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class EpaperController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all epapers from the database
        $epapers = Epaper::latest()->get();
        return view('admin.pages.epapers.index', compact('epapers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.epapers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'epaper_name'        => 'required|string|max:255',
            'epaper_title'       => 'nullable|string|max:255',
            'post_date'          => 'nullable|date',
            'epaper_image'       => 'nullable|string|max:1000',
            'epaper_image_alt'   => 'nullable|string|max:255',
            'epaper_image_url'   => 'nullable|url|max:1000',
            'language'           => 'nullable|string|max:10',
            'page_number'        => 'nullable|integer|min:1',
            'total_pages'        => 'nullable|integer|min:1',
            'epaper_pdf_url'     => 'nullable|url|max:1000',
            'epaper_category'    => 'nullable|string|max:255',
            'tags'               => 'nullable',
            'published_by'       => 'nullable|string|max:255',
            'region'             => 'nullable|string|max:255',
            'is_active'          => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); // 🔥 This is crucial
        }

        try {
            Epaper::create($request->only([
                'epaper_name',
                'epaper_title',
                'post_date',
                'epaper_image',
                'epaper_image_alt',
                'epaper_image_url',
                'language',
                'page_number',
                'total_pages',
                'epaper_pdf_url',
                'epaper_category',
                'tags',
                'published_by',
                'region',
                'is_active'
            ]));

            return redirect()->route('admin.epaper.index')->with('success', 'ePaper created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'An error occurred: ' . $e->getMessage());
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
            'epaper' => Epaper::findOrFail($id),
        ];
        return view('admin.pages.epapers.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Epaper $epaper)
    {
        $validator = Validator::make($request->all(), [
            'epaper_name'        => 'required|string|max:255',
            'epaper_title'       => 'nullable|string|max:255',
            'post_date'          => 'nullable|date',
            'epaper_image'       => 'nullable|string|max:1000',
            'epaper_image_alt'   => 'nullable|string|max:255',
            'epaper_image_url'   => 'nullable|url|max:1000',
            'language'           => 'nullable|string|max:10',
            'page_number'        => 'nullable|integer|min:1',
            'total_pages'        => 'nullable|integer|min:1',
            'epaper_pdf_url'     => 'nullable|url|max:1000',
            'epaper_category'    => 'nullable|string|max:255',
            'tags'               => 'nullable',
            'published_by'       => 'nullable|string|max:255',
            'region'             => 'nullable|string|max:255',
            'is_active'          => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $epaper->update($request->only([
                'epaper_name',
                'epaper_title',
                'post_date',
                'epaper_image',
                'epaper_image_alt',
                'epaper_image_url',
                'language',
                'page_number',
                'total_pages',
                'epaper_pdf_url',
                'epaper_category',
                'tags',
                'published_by',
                'region',
                'is_active'
            ]));

            return redirect()->route('admin.epaper.index')->with('success', 'ePaper updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'An error occurred while updating: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $epaper = Epaper::findOrFail($id);
        $epaper->delete();

    }
}
