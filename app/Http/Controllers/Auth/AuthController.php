<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Custom\Response;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
/**
 * @group Auth
 *
 */
class AuthController extends Controller
{
    private $user     = null;
    private $response = null;

    public function __construct()
    {
        $this->user     = auth('sanctum')->user();
        $this->response = new Response();
    }


    /**
     * Login
     *
     * Login the user with given data if valid.
     *
     * @bodyParam email    string The email of the user.
     * @bodyParam password string Password for the user.
     *
     * @return void
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->response->withoutData(false, $validator->errors()->first());

        }

        $validated = $validator->validated();

        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->response->withoutData(false, "You entered your account information incorrectly.");
        }

        $this->user = auth()->user();

        return $this->response->withData(
            true,
            "You have successfully logged in.",
            [
                'token' => auth()->user()->createToken('API Token')->plainTextToken,
                'user'  => UserResource::make($this->user)
            ]
        );
    }

    /**
     * Profile Update
     *
     * Profile Update the user with given data if valid.
     *
     * @bodyParam name string Name for the user.
     * @bodyParam surname string Surname for the user.
     * @bodyParam phone string Phone for the user.
     * @bodyParam email    string The email of the user.
     * @bodyParam password string Password for the user.
     *
     * @param Request $request
     * @return void
     * @authenticated
     */
    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable',
            'email' => 'nullable',
            'password' => 'nullable',
        ]);

        if ($validator->fails()) {
            return $this->response->withoutData(false, $validator->errors()->first());

        }

        $validated = $validator->validated();

        $user = User::where('id', $this->user->id)->first();

        if (!empty($request->name))
        {
            $user->update(['name' => $request->name]);
        }
        if (!empty($request->email))
        {
            $user->update(['email' => $request->email]);
        }

        if (!empty($request->password))
        {
            $user->update(['password' => bcrypt($request->password)]);
        }


        return $this->response->withData(
            true,
            "You somehow updated the user information.",
            [
                'user' => UserResource::make($user)
            ]
        );
    }

    /**
     * Register
     *
     * Register the user with given data if valid.
     *
     * @bodyParam email    string The email of the user.
     * @bodyParam password string Password for the user.
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->response->withoutData(false, $validator->errors()->first());

        }

        $validated = $validator->validated();

        $this->user = User::create([
            'name' => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);


        return $this->response->withData(
            true,
            "You have successfully registered.",
            [
                'token' => $this->user->createToken('API Token')->plainTextToken,
                'user'  => UserResource::make($this->user)
            ]
        );
    }

    /**
     * Profile
     *
     * Profile Detail
     *
     * @authenticated
     *
     * @return void
     *
     */
    public function detail()
    {
        return $this->response->withData(
            true,
            "User detail listed successfully.",
            UserResource::make($this->user)
        );
    }

    /**
     * Destroy User
     *
     * Destroy User with given parameters
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @authenticated
     */
    public function destroy($id)
    {
        User::where('id',$id)->delete();

        return $this->response->withData(
            true,
            "The user has been successfully deleted.",
            []
        );
    }



    /**
     * Logout
     *
     * Logout
     *
     * @authenticated
     *
     * @return void
     *
     */
    public function logout(){
        $this->user->tokens()->delete();

        return $this->response->withData(
            true,
            "Successfully logged out.",
            []
        );
    }
}
