<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *     title="Latihan Repo Pattern API",
 *     version="1.0.0",
 *     description="Dokumentasi API untuk Latihan Repository Pattern",
 *     @OA\Contact(
 *         email="aldyimam03@gmail.com"
 *     )
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     description="Masukkan token JWT Anda di sini. Contoh: Bearer {token}"
 * )
 */
class SwaggerController {}
