<?php

namespace App\Http\Controllers;

use App\Jobs\SendNewPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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

    public function resetPassword(Request $request)
    {
        $validator = Validator::make([
            'email' => $request->email
        ], [
            'email' => 'required|email|exists:users,email'
        ]);

        if($validator->fails()) {
            return response($validator->errors()->messages(), Response::HTTP_BAD_REQUEST);
        }

        $user = User::where('email', $$request->email);

        $newPassword = Str::random(8);
        $hashedPassword = bcrypt($newPassword);

        $user->update(['password' => $hashedPassword]);

        $details = [
            'recipient' => $user->email,
            'newPassword' => $newPassword
        ];

        SendNewPassword::dispatch($details);

        return response(['message' => 'Password has been successfully reset'], Response::HTTP_OK);
    }
}
