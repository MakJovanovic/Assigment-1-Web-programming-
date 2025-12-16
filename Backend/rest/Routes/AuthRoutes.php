<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
Flight::group('/auth', function() {
   /**
    * @OA\Post(
    *     path="/auth/register",
    *     summary="Register new user.",
    *     description="Add a new user to the database.",
    *     tags={"auth"},
    *     security={
    *         {"ApiKey": {}}
    *     },
    *     @OA\RequestBody(
    *         description="Add new user",
    *         required=true,
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                 required={"password", "email"},
    *                 @OA\Property(property="username", type="string", example="johndoe", description="User username"),
    *                 @OA\Property(property="password", type="string", example="some_password", description="User password"),
    *                 @OA\Property(property="email", type="string", example="demo@gmail.com", description="User email"),
    *                 @OA\Property(property="phone", type="string", example="061111111", description="User phone number"),
    *                 @OA\Property(property="role", type="string", enum={"admin", "user"}, example="user", description="User role")
    *             )
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="User has been added.",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="message", type="string", example="User registered successfully"),
    *             @OA\Property(
    *                 property="data",
    *                 type="object",
    *                 @OA\Property(property="id", type="integer", example=1),
    *                 @OA\Property(property="username", type="string", example="johndoe"),
    *                 @OA\Property(property="email", type="string", format="email", example="demo@gmail.com"),
    *                 @OA\Property(property="phone", type="string", example="061111111"),
    *                 @OA\Property(property="role", type="string", enum={"admin", "user"}, example="user")
    *             )
    *         )
    *     ),
    *     @OA\Response(response=500, description="Internal server error")
    * )
    */
   Flight::route("POST /register", function () {
       $data = Flight::request()->data->getData();


       $response = Flight::auth_service()->register($data);
  
       if ($response['success']) {
           Flight::json([
               'message' => 'User registered successfully',
               'data' => $response['data']
           ]);
       } else {
           Flight::halt(500, $response['error']);
       }
   });
   /**
    * @OA\Post(
    *      path="/auth/login",
    *      tags={"auth"},
    *      summary="Login to system using email and password",
    *      @OA\RequestBody(
    *          description="Credentials",
    *          required=true,
    *          @OA\JsonContent(
    *              required={"email","password"},
    *              @OA\Property(property="email", type="string", example="demo@gmail.com", description="User email address"),
    *              @OA\Property(property="password", type="string", example="some_password", description="User password")
    *          )
    *      ),
    *      @OA\Response(
    *           response=200,
    *           description="User data and JWT",
    *           @OA\JsonContent(
    *               type="object",
    *               @OA\Property(property="message", type="string", example="User logged in successfully"),
    *               @OA\Property(
    *                   property="data",
    *                   type="object",
    *                   @OA\Property(property="token", type="string", example="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."),
    *                   @OA\Property(
    *                       property="user",
    *                       type="object",
    *                       @OA\Property(property="id", type="integer", example=1),
    *                       @OA\Property(property="username", type="string", example="johndoe"),
    *                       @OA\Property(property="email", type="string", format="email", example="demo@gmail.com"),
    *                       @OA\Property(property="phone", type="string", example="061111111"),
    *                       @OA\Property(property="role", type="string", enum={"admin", "user"}, example="user")
    *                   )
    *               )
    *           )
    *      ),
    *      @OA\Response(response=500, description="Internal server error")
    * )
    */
   Flight::route('POST /login', function() {
       $data = Flight::request()->data->getData();


       $response = Flight::auth_service()->login($data);
  
       if ($response['success']) {
           Flight::json([
               'message' => 'User logged in successfully',
               'data' => $response['data']
           ]);
       } else {
           Flight::halt(500, $response['error']);
       }
   });
});
?>
