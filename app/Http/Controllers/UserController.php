<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    /**
     * Create a user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required|unique:users',
            'password' => 'string|required|confirmed',
            'fullname' => 'required',
            'role_id' => 'required|integer'
        ]);

        User::create($request->all());

        return response()->json([
            'message' => 'Utilisateur ajouté avec succès',
        ], 201);
    }

    /**
     * Delete a user
     *
     * @param int $id
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(int $id)
    {
        User::destroy($id);

        return response()->json(['message' => 'Utilisateur supprimé avec succès'], 200);
    }

    /**
     * Update a user
     *
     * @param Request $request 
     * @param integer $id
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id)
    {
        $this->validate($request, [
            'email' => ['email', 'required', Rule::unique('users')->ignore($id)],
            'fullname' => 'required',
            'role_id' => 'required|integer'
        ]);

        $user = User::find($id);
        $user->update($request->all());

        return response()->json(["{$user->fullname} a bien été mis à jour"], 200);
    }

    /**
     * Get a single a user
     *
     * @param int $id
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function single_user(int $id)
    {
        return response()->json(['user' => User::find($id)], 200);
    }

    /**
     * Get all the users
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $users = User::all();
        return response()->json(['users' => $users], 200);
    }

    /**
     * Log in the user
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        $password_correct = password_verify($request->password, optional($user)->password);

        if (!$password_correct || is_null($user)) {
            return response()->json(['message' => 'Email ou mot de passe incorrect.']);
        }

        $user->api_token = Str::random(150);
        $user->save();

        return response()->json([
            'message' => "Bienvenue M(me) {$user->fullname}",
            'token'   => $user->api_token,
            'auth'    => collect($user)->except(['api_token'])
        ], 200);
    }


    /**
     * Log out the user
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $user = User::find(auth()->user()->id);
        $user->update(['api_token' => null]);

        return response()->json(['message' => "Vous vous êtes déconnecté", 'state' => true], 200);
    }

    /**
     * Search users
     *
     * @param Request $request
     * @return Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $this->validate($request, [
            'fullname' => 'nullable|string'
        ]);

        $response = User::where('fullname', 'LIKE', "%{$request->fullname}%")->get();

        return response()->json(['users' => $response], 200);
    }
}
