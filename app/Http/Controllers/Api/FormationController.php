<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Formation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditFormationRequest;
use App\Http\Requests\FormationCreateRequest;
use App\Models\Candidature;
use App\Models\User_candidat;


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

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     /**
     * Display a listing of the candidatures.
     *
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *     path="/api/formations",
     *     summary="Get a listing of candidatures",
     *     tags={"Formations"},
     *     produces={"application/json"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     )
     * )
     */
    //liste de tous les formations avec les candidatures
    public function index()
    {
       
        $format = Candidature::All();
        return response()->json([
            'data' => $format
        ], 200);
    }

   
      /**
     * Get a listing of all formations.
     *
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *     path="/api/formations/formationdiff",
     *     summary="Get a listing of all formations",
     *     tags={"Formations"},
     *     produces={"application/json"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\Schema(
     *             type="object",
     *             @OA\Property(property="status_code", type="integer"),
     *             @OA\Property(property="status_message", type="string"),
     *             @OA\Property(property="data", type="array", @OA\Items())
     *         )
     *     )
     * )
     */

    public function formationdiff()
    {
        
        try {
         
            return response()->json([
                'status_code'=>200,
                'status_message'=>'la liste de tous les formations',
                'data'=> Formation::all()
            ]);
              
            } catch (Exception $e) {
                return response()->json($e);
            }
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
     * Store a newly created formation in storage.
     *
     * @param  \App\Http\Requests\FormationCreateRequest  $request
     * @return \Illuminate\Http\Response
     *
     * @OA\Post(
     *     path="/api/formations/store",
     *     summary="Store a new formation",
     *     tags={"Formations"},
     *     produces={"application/json"},
     *     @OA\Parameter(
     *         name="nom_de_formation",
     *         in="formData",
     *         type="string",
     *         description="Nom de la formation",
     *         required=true
     *     ),
     *     @OA\Parameter(
     *         name="description",
     *         in="formData",
     *         type="string",
     *         description="Description de la formation",
     *         required=true
     *     ),
     *     @OA\Parameter(
     *         name="date_de_debut",
     *         in="formData",
     *         type="string",
     *         format="date",
     *         description="Date de début de la formation (YYYY-MM-DD)",
     *         required=true
     *     ),
     *     @OA\Parameter(
     *         name="date_limite_d_inscription",
     *         in="formData",
     *         type="string",
     *         format="date",
     *         description="Date limite d'inscription à la formation (YYYY-MM-DD)",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Formation added successfully",
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error adding formation",
     *     )
     * )
     */

    public function store(FormationCreateRequest $request)
    {/*
        'nom_de_formation',
        'description',
        'date_de_debut',
        'date_limite_d\'inscription',
        $formations = new Formation();
        */
        $formations = new Formation();
        $formations->nom_de_formation = $request->nom_de_formation;
        $formations->description = $request->description;
        $formations->date_de_debut = $request->date_de_debut;
        $formations->date_limite_d_inscription= $request->date_limite_d_inscription;

        $formations->save();
        return response()->json([
            'status_code'=>200,
            'status_message'=>'la formation a été ajouté',
            'data'=>$formations
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
      
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
    /**
 * Update the specified formation in storage.
 *
 * 
 * @param  \App\Http\Requests\EditFormationRequest  $request
 * @param  \App\Models\Formation  $formations
 * @return \Illuminate\Http\Response
 *
 * @OA\Put(
 *     path="/api/formations/{formation}",
 *     summary="Update a formation",
 *     tags={"Formations"},
 *     produces={"application/json"},
 *     @OA\Parameter(
 *         name="formation",
 *         in="path",
 *         type="integer",
 *         description="ID of the formation to be updated",
 *         required=true
 *     ),
 *     @OA\Parameter(
 *         name="nom_de_formation",
 *         in="formData",
 *         type="string",
 *         description="New name of the formation",
 *         required=true
 *     ),
 *     @OA\Parameter(
 *         name="description",
 *         in="formData",
 *         type="string",
 *         description="New description of the formation",
 *         required=true
 *     ),
 *     @OA\Parameter(
 *         name="date_de_debut",
 *         in="formData",
 *         type="string",
 *         format="date",
 *         description="New date de début of the formation (YYYY-MM-DD)",
 *         required=true
 *     ),
 *     @OA\Parameter(
 *         name="date_limite_d_inscription",
 *         in="formData",
 *         type="string",
 *         format="date",
 *         description="New date limite d'inscription of the formation (YYYY-MM-DD)",
 *         required=true
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Formation updated successfully",
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Formation not found",
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error updating formation",
 *     )
 * )
 */


    public function update(EditFormationRequest  $request,Formation $formations )
    {
        try {
      
        $formations->nom_de_formation = $request->nom_de_formation;
        $formations->description = $request->description;
        $formations->date_de_debut = $request->date_de_debut;
        $formations->date_limite_d_inscription= $request->date_limite_d_inscription;

        $formations->save();
        return response()->json([
            'status_code'=>200,
            'status_message'=>'la formation a été modifié',
            'data'=>$formations
        ]);
              //code...
            } catch (Exception $e) {
               return response()->json($e);
            }

    }

    /**
     * Remove the specified resource from storage.
     */
    /**
 * Remove the specified formation from storage.
 *
 * @param  \App\Models\Formation  $formations
 * @return \Illuminate\Http\Response
 *
 * @OA\Delete(
 *     path="/api/formations/{formation}",
 *     summary="Remove a formation",
 *     tags={"Formations"},
 *     produces={"application/json"},
 *     @OA\Parameter(
 *         name="formation",
 *         in="path",
 *         type="integer",
 *         description="ID of the formation to be removed",
 *         required=true
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Formation removed successfully",
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Formation not found",
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error removing formation",
 *     )
 * )
 */
    public function destroy(Formation $formations)
    {
        try {
            //code...
             if($formations){
                    $formations->delete();
    
                    
                    return response()->json([
                        'status_code'=>200,
                        'status_message'=>'la formation a été supprimé',
                        'data'=>$formations
                    ]);
                }
            } catch (Exception $e) {
                return response()->json($e);
            }
              
    }
}
