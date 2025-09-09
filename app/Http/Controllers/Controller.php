<?php

namespace App\Http\Controllers;
/**
 * @OA\Info(
 *     title="NIBSS Service API",
 *     version="1.0.0",
 *     description="API documentation for NIBSS Service",
 *     @OA\Contact(
 *         email="admin@example.com"
 *     ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="API Server"
 * )
 *
 * @OA\Schema(
 *     schema="ApiSuccess",
 *     type="object",
 *     example={"status": "success", "message": "Operation completed", "data": {"key": "value"}},
 *     @OA\Property(property="status", type="string", example="success"),
 *     @OA\Property(property="message", type="string", example="Operation completed"),
 *     @OA\Property(property="data", type="object", nullable=true)
 * )
 *
 * @OA\Schema(
 *     schema="ApiError",
 *     type="object",
 *     example={"status": "error", "message": "Validation failed", "errors": {"bvn": {"The bvn field is required."}}},
 *     @OA\Property(property="status", type="string", example="error"),
 *     @OA\Property(property="message", type="string", example="Validation failed"),
 *     @OA\Property(
 *         property="errors",
 *         type="object",
 *         additionalProperties=@OA\Schema(type="array", @OA\Items(type="string")),
 *         nullable=true
 *     )
 * )
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 */

abstract class Controller
{
    //
}
