<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;
use Nette\Schema\ValidationException;

class AuthController extends Controller
{
    /**
     * Sign in a user and return an access token.
     *
     * This method checks if the email exists and the password is correct.
     * If successful, it returns user info and an API token.
     * If not, it returns an error message.
     *
     * @param SignInRequest $request
     * @return JsonResponse
     */

    public function signIn(SignInRequest $request)
    {
        try {

            $user = User::where('email', $request->post('email'))->first();

            if (!empty($user)) {

                if (Hash::check($request->post('password'), $user->password)) {
                    $token = $user->createToken('auth_token')->accessToken;
                    return response()->json([
                        'status' => true,
                        'message' => 'Successfully Login',
                        'data' => [
                            'name' => $user->name,
                            'email' => $user->email,
                            'role' => $user->role == ADMIN_ROLE ? 'Admin' : 'User',
                            'email_verified_at'=> (bool)$user->email_verified_at,
                        ],
                        'token' => $token
                    ], 200);

                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Incorrect Password',
                        'data' => []
                    ], 401);
                }

            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Email not found',
                    'data' => []
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => []
            ], 500);
        }
    }


    /**
     * Register a new user and generate an access token.
     *
     * This method takes the user's name, email, phone, and password from the request,
     * creates a new user in the database, and returns a JSON response
     * with the user details and a Passport auth token if registration is successful.
     *
     * @param SignUpRequest $request
     * @return JsonResponse
     * @throws \Throwable
     */

    public function signUp(SignUpRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = [
                'name' => $request->post('name'),
                'email' => $request->post('email'),
                'phone' => $request->post('phone'),
                'password' => Hash::make($request->post('password')),
            ];

            $user = User::create($data);

            $token = $user->createToken('auth_token')->accessToken;

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Customer registered successfully',
                'data' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role == ADMIN_ROLE ? 'Admin' : 'User',
                    'email_verified_at' => (bool)$user->email_verified_at,
                ],
                'token' => $token
            ], 201);

        } catch (ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $e->validator->errors()
            ], 422);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Log out the authenticated user by revoking their access token.
     *
     * This method retrieves the current user's API token and revokes it and
     * returns a JSON response indicating
     * success or failure.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        try {
            $user = Auth::guard('api')->user();

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not authenticated',
                    'data' => []
                ], 401);
            }

            $token = $user->token();
            $token->revoke();

            return response()->json([
                'status' => true,
                'message' => 'Successfully logged out',
                'data' => []
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong! Try again. ' . $e->getMessage(),
                'data' => []
            ], 500);
        }
    }

}
