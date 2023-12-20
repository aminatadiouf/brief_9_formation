<?php

namespace App\Http\Controllers\Api;

// use Exception;
// use App\Models\User;
// use Illuminate\Http\Request;
// use Tymon\JWTAuth\Facades\JWTAuth;
// use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Hash;
// use App\Http\Requests\UserCreateRequest;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserCreateRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /**
 * @OA\Get(
 *     path="/api/users",
 *     summary="Get a list of all users",
 *     tags={"Users"},
 *     produces={"application/json"},
 *     @OA\Response(
 *         response=200,
 *         description="List of users",
 *         @OA\Schema(
 *             type="array",
 *             @OA\Items(ref="#/definitions/User")
 *         )
 *     )
 * )
 */
    public function index()
    {
        $user = User::all();
        return response()->json([
            'status_code'=>200,
            'status_message'=>'vous vous êtes inscrits',
            'data'=>$user
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    
/**
 * @OA\Post(
 *     path="/api/users/register",
 *     summary="Register a new user",
 *     tags={"Users"},
 *     produces={"application/json"},
 *     @OA\Parameter(
 *         name="user",
 *         in="body",
 *         required=true,
 *         @OA\Schema(ref="#/definitions/User")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User registered successfully",
 *         @OA\Schema(ref="#/definitions/User")
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error registering user",
 *     )
 * )
 */
    public function register(Request $request)
    {
        
       
        try {
      
      
            $users = new User();

            $users->name = $request->name;
            $users->email = $request->email;
            $users->telephone = $request->telephone;
            $users->date_de_naissance = $request->date_de_naissance;
            $users->password = Hash::make($request->password);

          
           
         
        
            $users->save();
       
            return response()->json([
                'status_code'=>200,
                'status_message'=>'vous vous êtes inscrits',
                'data'=>$users
            ]);
        } catch (Exception $e) {
           return response()->json($e);
        } 
    }

/**
 * @OA\Post(
 *     path="/api/users/login",
 *     summary="Login a user",
 *     tags={"Users"},
 *     produces={"application/json"},
 *     @OA\Parameter(
 *         name="credentials",
 *         in="body",
 *         required=true,
 *         @OA\Schema(
 *             type="object",
 *             @OA\Property(property="email", type="string"),
 *             @OA\Property(property="password", type="string"),
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User logged in successfully",
 *         @OA\Schema(ref="#/definitions/LoginResponse")
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Invalid details",
 *     )
 * )
 */

    public function login(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

         // JWTAuth
         $token = JWTAuth::attempt([
            "email" => $request->email,
            "password" => $request->password
        ]);

        if(!empty($token)){

            return response()->json([
                "status" => true,

                "message" => "vous vous êtes connectés avec succés",
                "token" => $token
            ]);
        }

        return response()->json([
            "status" => false,
            "message" => "Invalid details"
        ]);

    }

    /**
 * @OA\Post(
 *     path="/api/users/logout",
 *     summary="Logout a user",
 *     tags={"Users"},
 *     produces={"application/json"},
 *     @OA\Response(
 *         response=200,
 *         description="User logged out successfully",
 *         @OA\Schema(ref="#/definitions/LogoutResponse")
 *     )
 * )
 */

        public function logoutUser(User $users)
        {
            auth()->logout();
          
            return response()->json([
               // "data"=>$users,
                "status" => true,
                "message" => "vous vous êtes déconnecté,see you next-time "
            ]);
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
