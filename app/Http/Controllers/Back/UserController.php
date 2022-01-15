<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenerateApiTokenRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('back.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.user.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo' => $request->hasFile('photo') ? $request->file('photo')->getClientOriginalName() : 'default.png',
            'is_admin' => $request->is_admin ? true : false
        ]);

        if ($request->hasFile('photo')) {
            Storage::putFileAs('public/userPhotos', $request->file('photo'), $request->file('photo')->getClientOriginalName());
        }
        return view('back.user.form', compact('user'))->with('actionOnUser', 'Usuario creado correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('back.user.form', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::find($request->id);

        if ($request->hasFile('photo')) {
            Storage::putFileAs('public/userPhotos', $request->file('photo'), $request->file('photo')->getClientOriginalName());
            if ($user->photo != 'default.png') {
                unlink(public_path('storage/userPhotos/' . $user->photo));
            }
        }

        $user->fill([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo' => $request->hasFile('photo') ? $request->file('photo')->getClientOriginalName() : $user->photo,
            'is_admin' => $request->is_admin ? true : false
        ]); 
        $user->save();

        return view('back.user.form', compact('user'))->with('actionOnUser', 'Usuario actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('back.user.index')->with('actionOnUser', 'Usuario eliminado correctamente');
    }

    public function createApiToken()
    {
        return view('back.user.apiToken');
    }

    public function generateApiToken(GenerateApiTokenRequest $request)
    {
        $token['value'] = auth()->guard('api')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);

        if (isset($token['value'])) {
            $token['type'] = 'Bearer';
            $token['duration'] = auth()->guard('api')->factory()->getTTL();

            return view('back.user.apiToken', compact('token'))
                   ->with('tokenResponse', 'Token generado correctamente.');
        } else {
            return view('back.user.apiToken')
                   ->with('tokenResponse', 'Credenciales inválidas');
        }
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
