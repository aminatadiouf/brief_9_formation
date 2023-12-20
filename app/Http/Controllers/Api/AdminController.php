<?php

namespace App\Http\Controllers\Api;


use Exception;
use App\Models\Admin;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminCreateRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;  // Remplacez la classe Illuminate\Http\Client\Request par Illuminate\Http\Request
use Illuminate\Support\Facades\Config;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *      title="Admin API",
 *      version="1.0",
 *      description="API for managing admin users"
 * )
 * 
 * @OA\Server(
 *      url="http://localhost:8000/api"
 * )
 */


class AdminController extends Controller
{

    public function __construct()
{
    Config::set('auth.defaults.guard','admin_api');
}

    /**
     * Display a listing of the admins.
     *
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *     path="/api/admins",
     *     summary="Get a listing of admins",
     *     tags={"Admins"},
     *     produces={"application/json"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     )
     * )
     */
  /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return 'les candidats';
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
     * Store a newly created admin in storage.
     *
     * @param  \App\Http\Requests\AdminCreateRequest  $request
     * @return \Illuminate\Http\Response
     *
     * @OA\Post(
     *     path="/api/admins/register",
     *     summary="Register a new admin",
     *     tags={"Admins"},
     *     produces={"application/json"},
     *     @OA\Parameter(
     *         name="name_admin",
     *         in="formData",
     *         type="string",
     *         description="Admin name",
     *         required=true
     *     ),
     *     @OA\Parameter(
     *         name="email_admin",
     *         in="formData",
     *         type="string",
     *         description="Admin email",
     *         required=true
     *     ),
     *     @OA\Parameter(
     *         name="numero_de_telephone",
     *         in="formData",
     *         type="string",
     *         description="Admin phone number",
     *         required=true
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="formData",
     *         type="string",
     *         description="Admin password",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Admin registered successfully",
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error registering admin",
     *     )
     * )
     */
    public function registerAdmin(AdminCreateRequest $request)
    {
        
       
        try {
      
      
            $admins = new Admin();

            $admins->name_admin = $request->name_admin;
            $admins->email_admin = $request->email_admin;
            $admins->numero_de_telephone = $request->numero_de_telephone;
            $admins->password = Hash::make($request->password);

          
           
         
        
            $admins->save();
       
            return response()->json([
                'status_code'=>200,
                'status_message'=>'vous vous êtes inscrits en tant que admin',
                'data'=>$admins
            ]);
        } catch (Exception $e) {
           return response()->json($e);
        } 
    }


     /**
     * Login admin and return a token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @OA\Post(
     *     path="/api/admins/login",
     *     summary="Login as an admin",
     *     tags={"Admins"},
     *     produces={"application/json"},
     *     @OA\Parameter(
     *         name="email_admin",
     *         in="formData",
     *         type="string",
     *         description="Admin email",
     *         required=true
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="formData",
     *         type="string",
     *         description="Admin password",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful login",
     *         @OA\Schema(
     *             type="object",
     *             @OA\Property(property="token", type="string", description="JWT token")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Invalid email or password",
     *     )
     * )
     */
public function loginAdmin(Request $request)
{
    try {
        //code...
   
    $credentials = $request->only('email_admin', 'password');

    if (!$token = Auth::guard('admin_api')->attempt($credentials)) {
        return response()->json(['message' => 'Invalid email or password'], 401);
    }

    return response()->json(['token' => $token]);
} catch (Exception $e) {
  return response()->json($e);
}
}
       

// public function logoutAdmin(Request $request)
//         {
          
    
           
//             JWTAuth::guard('admin_api')->invalidate(JWTAuth::getToken());
        
                
            
          
//             return response()->json([
//                 "status" => true,
//                 "message" => "vous vous êtes déconnecté,see you next-time "
//             ]);
//         }
    
        
        
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
