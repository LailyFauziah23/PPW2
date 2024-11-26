<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


/**
 * @OA\Info(
 *     description="Contoh API documentation menggunakan OpenAPI/Swagger",
 *     version="0.0.1",
 *     title="Contoh API Documentation",
 *     termsOfService="http://swagger.io/terms/",
 *     @OA\Contact(
 *         email="choirudin.emcha@gmail.com"
 *     ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 */

class GreetController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/greet",
     *     tags={"greeting"},
     *     summary="Returns a Sample API response",
     *     description="A sample greeting to test out the API",
     *     operationId="greet",
     *     @OA\Parameter(
     *         name="firstname",
     *         description="Nama depan",
     *         required=true,
     *         in="query",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="lastname",
     *         description="Nama belakang",
     *         required=true,
     *         in="query",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="string",
     *             example="Halo John Doe"
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Missing data"
     *     )
     * )
     */
    public function greet(Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
        ]);

        return response()->json([
            'message' => 'Halo ' . $validatedData['firstname'] . ' ' . $validatedData['lastname'],
        ], 200);
    }
}
