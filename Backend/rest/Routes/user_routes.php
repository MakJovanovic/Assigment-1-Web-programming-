<?php
/**
 * @OA\Get(
 *     path="/users",
 *     summary="Get all users",
 *     tags={"Users"},
 *     @OA\Response(
 *         response=200,
 *         description="List of all users",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="username", type="string", example="johndoe"),
 *                 @OA\Property(property="email", type="string", format="email", example="john@example.com"),
 *                 @OA\Property(property="phone", type="string", example="061111111"),
 *                 @OA\Property(property="role", type="string", enum={"admin", "user"}, example="user")
 *             )
 *         )
 *     ),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('GET /users', function() {
   Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
   Flight::json(Flight::userService()->getAllUsers());
});

/**
 * @OA\Get(
 *     path="/users/{id}",
 *     summary="Get user by ID",
 *     tags={"Users"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="User ID",
 *         @OA\Schema(type="integer", format="int64")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User details",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="username", type="string", example="johndoe"),
 *             @OA\Property(property="email", type="string", format="email", example="john@example.com"),
 *             @OA\Property(property="phone", type="string", example="061111111"),
 *             @OA\Property(property="role", type="string", enum={"admin", "user"}, example="user")
 *         )
 *     ),
 *     @OA\Response(response=404, description="User not found"),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('GET /users/@id', function($id) {
   Flight::auth_middleware()->authorizeRoles([Roles::USER, Roles::ADMIN]);
   Flight::json(Flight::userService()->getUserById($id));
});

/**
 * @OA\Get(
 *     path="/users/username/{username}",
 *     summary="Get user by username",
 *     tags={"Users"},
 *     @OA\Parameter(
 *         name="username",
 *         in="path",
 *         required=true,
 *         description="Username",
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User details",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="username", type="string", example="johndoe"),
 *             @OA\Property(property="email", type="string", format="email", example="john@example.com"),
 *             @OA\Property(property="phone", type="string", example="061111111"),
 *             @OA\Property(property="role", type="string", enum={"admin", "user"}, example="user")
 *         )
 *     ),
 *     @OA\Response(response=404, description="User not found"),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('GET /users/username/@username', function($username) {
   Flight::auth_middleware()->authorizeRoles([Roles::USER, Roles::ADMIN]);
   Flight::json(Flight::userService()->getUserByUsername($username));
});

/**
 * @OA\Post(
 *     path="/users",
 *     summary="Create a new user",
 *     tags={"Users"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             required={"username", "email", "password"},
 *             @OA\Property(property="username", type="string", example="johndoe"),
 *             @OA\Property(property="email", type="string", format="email", example="john@example.com"),
 *             @OA\Property(property="password", type="string", example="securepassword123"),
 *             @OA\Property(property="phone", type="string", example="061111111"),
 *             @OA\Property(property="role", type="string", enum={"admin", "user"}, example="user")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User created successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="username", type="string", example="johndoe"),
 *             @OA\Property(property="email", type="string", format="email", example="john@example.com"),
 *             @OA\Property(property="phone", type="string", example="061111111"),
 *             @OA\Property(property="role", type="string", enum={"admin", "user"}, example="user")
 *         )
 *     ),
 *     @OA\Response(response=400, description="Invalid input"),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('POST /users', function() {
   Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
   $data = Flight::request()->data->getData();
   Flight::json(Flight::userService()->addUser($data));
});

/**
 * @OA\Patch(
 *     path="/users/{id}",
 *     summary="Update a user",
 *     tags={"Users"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="User ID",
 *         @OA\Schema(type="integer", format="int64")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="username", type="string", example="johndoe"),
 *             @OA\Property(property="email", type="string", format="email", example="john@example.com"),
 *             @OA\Property(property="password", type="string", example="newpassword123"),
 *             @OA\Property(property="phone", type="string", example="061111111"),
 *             @OA\Property(property="role", type="string", enum={"admin", "user"}, example="user")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User updated successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="username", type="string", example="johndoe"),
 *             @OA\Property(property="email", type="string", format="email", example="john@example.com"),
 *             @OA\Property(property="phone", type="string", example="061111111"),
 *             @OA\Property(property="role", type="string", enum={"admin", "user"}, example="user")
 *         )
 *     ),
 *     @OA\Response(response=404, description="User not found"),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('PATCH /users/@id', function($id) {
   Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
   $data = Flight::request()->data->getData();
   Flight::json(Flight::userService()->updateUser($id, $data));
});

/**
 * @OA\Delete(
 *     path="/users/{id}",
 *     summary="Delete a user",
 *     tags={"Users"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="User ID",
 *         @OA\Schema(type="integer", format="int64")
 *     ),
 *     @OA\Response(response=200, description="User deleted successfully"),
 *     @OA\Response(response=404, description="User not found"),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('DELETE /users/@id', function($id) {
   Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
   Flight::userService()->deleteUser($id);
});

?>
