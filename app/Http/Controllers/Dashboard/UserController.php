<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if(auth()->user()->cannot('read users')) {
            return abort(403);
        }

        $users = User::where([
            [function ($query) use ($request) {
                if($term = $request->search){
                    $query->where('first_name' , 'LIKE', '%' . $term . '%')
                        ->orWhere('last_name' , 'LIKE', '%' . $term . '%')
                        ->orWhereRaw("concat(first_name, ' ', last_name) like '%{$term}%' ");
                }
            }]
        ])
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('dashboard.users.index', [ 'users' => $users ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(auth()->user()->cannot('create users')) {
            abort(403);
        }


        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'image' => ['file'],
            'password' => ['required', 'confirmed'],
            'permissions' => ['array']
        ]);
        $requestData = Arr::except($validated, ['_token', '_method', 'image', 'password', 'permissions']);


        if($request->image) {
            // Compress and store image
            $hashImageName = $request->image->hashName();

            Image::make($request->image)->fit(320 , 320, function ($constraint){
                $constraint->aspectRatio();
            })->save(public_path('uploads/user-images/') . $request->image->hashName());

            $requestData['image'] = $hashImageName;
        }else {

            $requestData['image'] = 'default.jpg';
        }


        // Hash password
        $requestData['password'] = Hash::make($request->password);

        // Create user
        $user = User::create($requestData);

        // Add permissions to user was created
        $user->syncPermissions($request->permissions);

        session()->flash('success', __('site.added_successfully'));

        return redirect(route('dashboard.users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if(auth()->user()->cannot('edit users')) {
            abort(403);
        }

        $user = User::find($id);

        $permissions = $user->permissions->pluck('name')->all();

        return view('dashboard.users.edit', ['user' => $user, 'permissions' => $permissions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = User::find($id);

        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'image' => ['file'],
            'permissions' => ['array']
        ]);

        $requestData = $request->except(['_token', '_method', 'image', 'password', 'permissions']);

        if($request->image) {
           if($user->image !== 'default.jpg') {
                // delete old image
                Storage::disk('public_uploads')->delete('user-images/' . $user->image);
           }
            // store new image
            $hashImageName = $request->image->hashName();

            Image::make($request->image)->fit(320 , 320, function ($constraint){
                $constraint->aspectRatio();
            })->save(public_path('uploads/user-images/') . $request->image->hashName());

            $requestData['image'] = $hashImageName;
        }

        // sync permissions
        $user->syncPermissions($request->permissions);

        $user->update($requestData);

        session()->flash('success', __('site.updated_successfully'));

        return redirect(route('dashboard.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(auth()->user()->cannot('delete users')) {
            return abort(403);
        }

        $user = User::find($id);

        if($user->image !== 'default.jpg') {
            // delete old image
            Storage::disk('public_uploads')->delete('user-images/' . $user->image);
       }

        // Delete image from storage
        $user->delete();

        session()->flash('success', __('site.deleted_successfully'));

        return redirect(route('dashboard.users.index'));
    }
}
