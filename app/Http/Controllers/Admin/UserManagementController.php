<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin;
use App\Models\Setting;
use App\Mail\UserVerifyMail;
use Illuminate\Http\Request;
// use App\Events\ActivityLogged;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;


class UserManagementController extends Controller
{

    protected $middleware = [
        'permission:view user|create user|show user|edit user|delete user' => ['only' => ['index', 'create', 'show', 'edit', 'destroy']],
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.user.index', ['users' => User::get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.user.create', ['roles' => Role::get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name'                        => $request->name,
            'email'                       => $request->email,
            'username'                    => $request->username,
            'phone'                       => $request->phone,
            'address'                     => $request->address,
            'profile_image'               => $request->profile_image,
            'country'                     => $request->country,
            'city'                        => $request->city,
            'zipcode'                     => $request->zipcode,
            'role'                        => 'user',
            'status'                      => $request->status ? $request->status : 'active',
            'password'                    => Hash::make($request->password),
        ]);

        event(new Registered($user));
        // event(new ActivityLogged('User created', $user));

        return redirect()->back()->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        $deliveredOrders = $user->order()->delivered()->get();
        $cancelledOrders = $user->order()->cancelled()->get();
        $totalPurchaseAmount = $deliveredOrders->sum('total_amount');
        return view('admin.pages.user.show', [
            'user'                => $user,
            'deliveredOrders'     => $deliveredOrders,
            'totalPurchaseAmount' => $totalPurchaseAmount,
            'cancelledOrders'     => $cancelledOrders,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.pages.user.edit', [
            'user' => User::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'first_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:' . User::class . ',email,' . $user->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->update([
            'name'                        => $request->name,
            'email'                       => $request->email,
            'username'                    => $request->username,
            'phone'                       => $request->phone,
            'address'                     => $request->address,
            'profile_image'               => $request->profile_image,
            'country'                     => $request->country,
            'city'                        => $request->city,
            'zipcode'                     => $request->zipcode,
            'role'                        => 'user',
            'status'                      => $request->status ? $request->status : 'active',
            'password'                    => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        // event(new ActivityLogged('User updated', $user));

        return redirect()->back()->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        // event(new ActivityLogged('User deleted', $user));
    }
    public function toggleStatus(string $id)
    {
        $user = User::findOrFail($id);
        $user->status = $user->status == 'active' ? 'inactive' : 'active';
        $user->save();
        $setting = Setting::first();
        // Mail::to($user->email)->send(new UserVerifyMail($user->name, $setting));
        return response()->json(['success' => true]);
    }
}
