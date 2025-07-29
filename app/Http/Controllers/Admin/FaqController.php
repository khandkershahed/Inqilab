<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['faqs'] = Faq::latest('id')->get();
        return view('admin.pages.faq.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question'       => 'required|string|max:255',
            'answer'         => 'required|string',
            'tag'            => 'nullable|string|max:255',
            'order'          => 'integer|min:0|unique:faqs,order',
            'status'         => 'required|in:active,inactive',
            'views'          => 'integer|min:0',
            'related_faqs'   => 'nullable|json',
            'is_featured'    => 'boolean',
            'additional_info' => 'nullable|string',
        ], [
            'question.required'         => 'The question field is required.',
            'question.string'           => 'The question must be a string.',
            'question.max'              => 'The question may not be greater than :max characters.',
            'answer.required'           => 'The answer field is required.',
            'answer.string'             => 'The answer must be a string.',
            'tag.string'                => 'The tag must be a string.',
            'tag.max'                   => 'The tag may not be greater than :max characters.',
            'order.integer'             => 'The order must be an integer.',
            'order.min'                 => 'The order must be at least :min.',
            'order.unique'              => 'The order value has already been taken.',
            'status.required'           => 'The status field is required.',
            'status.in'                 => 'The status must be one of: active, inactive.',
            'views.integer'             => 'The views must be an integer.',
            'views.min'                 => 'The views must be at least :min.',
            'related_faqs.json'         => 'The related FAQs must be a valid JSON string.',
            'is_featured.boolean'       => 'The is featured field must be true or false.',
            'additional_info.string'    => 'The additional info must be a string.',
        ]);

        if ($validator->fails()) {
            foreach ($validator->messages()->all() as $message) {
                Session::flash('error', $message);
            }
            return redirect()->back()->withInput();
        }

        Faq::create([
            'question'     => $request->question,
            'answer'       => $request->answer,
            'tag'          => $request->tag,
            'order'        => $request->order,
            'status'       => $request->status,
            'views'        => $request->views,
            'related_faqs' => $request->related_faqs,
            'is_featured'  => $request->is_featured,
        ]);
        return redirect()->back()->with('success', 'Data has been saved successfully!');
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
        $data['faq'] = Faq::findOrFail($id);
        return view('admin.pages.faq.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $faq = Faq::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'question'          => 'required|string|max:255',
            'answer'            => 'required|string',
            'tag'               => 'nullable|string|max:255',
            'order'             => 'integer|min:0|unique:faqs,order,' . $faq->id,
            'status'            => 'required|in:active,inactive',
            'views'             => 'integer|min:0',
            'related_faqs'      => 'nullable|json',
            'is_featured'       => 'boolean',
            'additional_info'   => 'nullable|string',
        ], [
            'question.required'         => 'The question field is required.',
            'question.string'           => 'The question must be a string.',
            'question.max'              => 'The question may not be greater than :max characters.',
            'answer.required'           => 'The answer field is required.',
            'answer.string'             => 'The answer must be a string.',
            'tag.string'                => 'The tag must be a string.',
            'tag.max'                   => 'The tag may not be greater than :max characters.',
            'order.integer'             => 'The order must be an integer.',
            'order.min'                 => 'The order must be at least :min.',
            'order.unique'              => 'The order value has already been taken.',
            'status.required'           => 'The status field is required.',
            'status.in'                 => 'The status must be one of: active, inactive.',
            'views.integer'             => 'The views must be an integer.',
            'views.min'                 => 'The views must be at least :min.',
            'related_faqs.json'         => 'The related FAQs must be a valid JSON string.',
            'is_featured.boolean'       => 'The is featured field must be true or false.',
            'additional_info.string'    => 'The additional info must be a string.',
        ]);

        if ($validator->fails()) {
            foreach ($validator->messages()->all() as $message) {
                Session::flash('error', $message);
            }
            return redirect()->back()->withInput();
        }

        $faq->update([
            'question'          => $request->question,
            'answer'            => $request->answer,
            'tag'               => $request->tag,
            'order'             => $request->order,
            'status'            => $request->status,
            'views'             => $request->views,
            'related_faqs'      => $request->related_faqs,
            'is_featured'       => $request->is_featured,
            'additional_info'   => $request->additional_info,
        ]);

        return redirect()->back()->with('success', 'Data has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Faq::find($id)->delete();
    }
}
