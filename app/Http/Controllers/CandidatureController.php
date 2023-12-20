<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use Exception;
use Illuminate\Http\Request;
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
class CandidatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

 /**
 * @OA\Post(
 *     path="/api/candidatures",
 *     summary="Create a new candidature",
 *     tags={"Candidatures"},
 *     produces={"application/json"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CandidatureRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Candidature created successfully",
 *         @OA\JsonContent(ref="#/components/schemas/CandidatureResponse")
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="User has already applied to this formation",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status_code", type="integer", example=400),
 *             @OA\Property(property="status_message", type="string", example="L'utilisateur a déjà candidaté à cette formation."),
 *             @OA\Property(property="data", type="null"),
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error creating candidature",
 *     )
 * )
 */
    public function store(Request $request)
    {
        try {

           $user_id = auth()->user()->id;
            $formation_id = $request->formation_id;
           
            $existCandidature = Candidature::where('user_id', $user_id)
            ->where('formation_id', $formation_id)
            ->first();

        if ($existCandidature) {
            return response()->json([
                'status_code' => 400,
                'status_message' => 'L\'utilisateur a déjà candidaté à cette formation.',
                'data' => null
            ]);
            }
        
        $candidature = new Candidature();
        $candidature->user_id = auth()->user()->id;
        $candidature->formation_id = $request->formation_id;
        $candidature->save();
        return response()->json([
            
            'status_code'=>200,
            'status_message'=>'la candidature a été ajouté',
            'data'=>$candidature]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    
    }
   
    /**
 * @OA\Get(
 *     path="/api/candidatures/liste-accept",
 *     summary="Get a list of accepted candidatures",
 *     tags={"Candidatures"},
 *     produces={"application/json"},
 *     @OA\Response(
 *         response=200,
 *         description="List of accepted candidatures",
 *         @OA\Schema(ref="#/definitions/CandidatureList")
 *     )
 * )
 */

    public function listecandidatureAccept(Candidature $candidature)
    {
        $listeAccept = $candidature::where (['statut_recervation' => 'accepte'])->get();

        return response()->json([
            'data'=>$candidature,
            'liste des mentores archivés' =>$listeAccept]);
    }

    /**
 * @OA\Get(
 *     path="/api/candidatures/liste-decline",
 *     summary="Get a list of declined candidatures",
 *     tags={"Candidatures"},
 *     produces={"application/json"},
 *     @OA\Response(
 *         response=200,
 *         description="List of declined candidatures",
 *         @OA\Schema(ref="#/definitions/CandidatureList")
 *     )
 * )
 */

    public function listecandidatureDecline(Candidature $candidature)
    {
        $listedecline = $candidature::where (['statut_recervation' => 'decline'])->get();

        return response()->json([
            'data'=>$candidature,
            'liste des mentores archivés' =>$listedecline]);
    }

/**
 * @OA\Post(
 *     path="/api/candidatures/accept/{candidature}",
 *     summary="Accept a candidature",
 *     tags={"Candidatures"},
 *     produces={"application/json"},
 *     @OA\Parameter(
 *         name="candidature",
 *         in="path",
 *         type="string",
 *         required=true,
 *         description="ID of the candidature to accept"
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Candidature accepted successfully",
 *         @OA\Schema(ref="#/definitions/CandidatureAcceptDecline")
 *     )
 * )
 */

    public function acceptCandidature(Candidature $candidature)
    {
        $candidature->update(['statut_recervation' => 'accepte']);
        $candidature->save();

        return response()->json(['message' => 'la candidature a été accepté',
                                'data'=>$candidature]);
    }


/**
 * @OA\Post(
 *     path="/api/candidatures/decline/{candidature}",
 *     summary="Decline a candidature",
 *     tags={"Candidatures"},
 *     produces={"application/json"},
 *     @OA\Parameter(
 *         name="candidature",
 *         in="path",
 *         type="string",
 *         required=true,
 *         description="ID of the candidature to decline"
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Candidature declined successfully",
 *         @OA\Schema(ref="#/definitions/CandidatureAcceptDecline")
 *     )
 * )
 */

    public function refuseCandidature(Candidature $candidature)
    {
        $candidature->update(['statut_recervation' => 'decline']);
        $candidature->save();

        return response()->json(['message' => 'la candidature a été decliné',
                                'data'=>$candidature]);
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
