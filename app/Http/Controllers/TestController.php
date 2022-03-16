<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{


    /**
     * @OA\Post(
     *      path="/products/nomenclatures/toArchive",
     *      tags={"Archives"},
     *      summary="Nomenclatures to Archive",
     *      @OA\RequestBody(
     *          description="Nomenclatures to Archive",
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(
     *                    type="array",
     *                    collectionFormat="multi",
     *                    property="nomenclatures",
     *                    @OA\Items(
     *                       @OA\Property(
     *                          property="id",
     *                          type="integer",
     *                          example=5,
     *                       ),
     *                  )
     *               )
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized user",
     *      ),
     * )
     */

    public function Test()
    {
        return "test";
    }
}
