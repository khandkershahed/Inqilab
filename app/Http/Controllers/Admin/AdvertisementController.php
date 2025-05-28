<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Illuminate\Http\Request;

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
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'ad_type' => 'required|in:image,html,video,script',
            'image_path' => 'nullable|required_if:ad_type,image|string|max:1000',
            'video_path' => 'nullable|required_if:ad_type,video|string|max:1000',
            'html_code' => 'nullable|required_if:ad_type,html|required_if:ad_type,script|string',
            'link' => 'nullable|url|max:1000',
            'target_blank' => 'boolean',
            'position' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'priority' => 'nullable|integer|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:pending,approved,rejected,expired',
            'is_active' => 'boolean',
            'company_name' => 'nullable|string|max:255',
            'company_website' => 'nullable|url|max:1000',
            'user_id' => 'nullable|exists:users,id',
        ], [
            'ad_type.required' => 'Ad type is required.',
            'image_path.required_if' => 'Image path is required for image ads.',
            'video_path.required_if' => 'Video path is required for video ads.',
            'html_code.required_if' => 'HTML code is required for HTML or script ads.',
            'link.url' => 'The ad link must be a valid URL.',
            'company_website.url' => 'The company website must be a valid URL.',
            'end_date.after_or_equal' => 'End date must be after or equal to start date.',
        ]);

        if ($validator->fails()) {
            foreach ($validator->messages()->all() as $message) {
                Session::flash('error', $message);
            }
            return redirect()->back()->withInput();
        }

        // Optional: generate a code like AD-280524-001
        $typePrefix = 'AD';
        $today = date('dmy');
        $lastCode = Advertisement::where('created_at', 'like', now()->format('Y-m-d') . '%')
            ->orderBy('id', 'desc')->first();
        $newNumber = $lastCode ? (int) substr($lastCode->code ?? '0', -3) + 1 : 1;
        $code = $typePrefix . '-' . $today . '-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        $data = $validator->validated();

        $advertisement = new Advertisement();
        $advertisement->code = $code;
        $advertisement->title = $data['title'] ?? null;
        $advertisement->ad_type = $data['ad_type'];
        $advertisement->image_path = $data['ad_type'] === 'image' ? $data['image_path'] : null;
        $advertisement->video_path = $data['ad_type'] === 'video' ? $data['video_path'] : null;
        $advertisement->html_code = in_array($data['ad_type'], ['html', 'script']) ? $data['html_code'] : null;
        $advertisement->link = $data['link'] ?? null;
        $advertisement->target_blank = $data['target_blank'] ?? false;
        $advertisement->position = $data['position'] ?? null;
        $advertisement->price = $data['price'] ?? 0.00;
        $advertisement->priority = $data['priority'] ?? 0;
        $advertisement->start_date = $data['start_date'] ?? now();
        $advertisement->end_date = $data['end_date'] ?? null;
        $advertisement->status = $data['status'];
        $advertisement->is_active = $data['is_active'] ?? true;
        $advertisement->company_name = $data['company_name'] ?? null;
        $advertisement->company_website = $data['company_website'] ?? null;
        $advertisement->user_id = $data['user_id'] ?? null;
        $advertisement->views = 0;
        $advertisement->clicks = 0;
        $advertisement->ip_address = $request->ip(); // Track IP (optional)

        $advertisement->save();

        return redirect()->route('advertisements.index')->with('success', 'Advertisement created successfully.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
