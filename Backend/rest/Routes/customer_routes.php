<?php
/**
 * @OA\Get(
 *     path="/customers",
 *     summary="Get all customers",
 *     tags={"Customers"},
 *     @OA\Response(
 *         response=200,
 *         description="List of all customers",
 *         @OA\JsonContent(type="array")
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server error",
 *         @OA\JsonContent(type="object")
 *     )
 * )
 */
Flight::route('GET /customers', function() {
    Flight::json(Flight::customerService()->getAllCustomers());
});

/**
 * @OA\Get(
 *     path="/customers/{id}",
 *     summary="Get customer by ID",
 *     tags={"Customers"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Customer ID",
 *         @OA\Schema(type="integer", format="int64")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Customer details",
 *         @OA\JsonContent(type="object")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Customer not found",
 *         @OA\JsonContent(type="object")
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server error",
 *         @OA\JsonContent(type="object")
 *     )
 * )
 */
Flight::route('GET /customers/@id', function($id) {
    Flight::json(Flight::customerService()->getCustomerById($id));
});

/**
 * @OA\Get(
 *     path="/customers/user/{user_id}",
 *     summary="Get customer by user ID",
 *     tags={"Customers"},
 *     @OA\Parameter(
 *         name="user_id",
 *         in="path",
 *         required=true,
 *         description="User ID",
 *         @OA\Schema(type="integer", format="int64")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Customer details",
 *         @OA\JsonContent(type="object")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Customer not found",
 *         @OA\JsonContent(type="object")
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server error",
 *         @OA\JsonContent(type="object")
 *     )
 * )
 */
Flight::route('GET /customers/user/@user_id', function($user_id) {
    Flight::json(Flight::customerService()->getCustomerByUserId($user_id));
});

/**
 * @OA\Get(
 *     path="/customers/email/{email}",
 *     summary="Get customer by email",
 *     tags={"Customers"},
 *     @OA\Parameter(
 *         name="email",
 *         in="path",
 *         required=true,
 *         description="Customer email address",
 *         @OA\Schema(type="string", format="email")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Customer details",
 *         @OA\JsonContent(type="object")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Customer not found",
 *         @OA\JsonContent(type="object")
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server error",
 *         @OA\JsonContent(type="object")
 *     )
 * )
 */
Flight::route('GET /customers/email/@email', function($email) {
    Flight::json(Flight::customerService()->getCustomerByEmail($email));
});

/**
 * @OA\Get(
 *     path="/customers/search/{last_name}",
 *     summary="Search customers by last name",
 *     tags={"Customers"},
 *     @OA\Parameter(
 *         name="last_name",
 *         in="path",
 *         required=true,
 *         description="Last name to search for",
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="List of customers matching the last name",
 *         @OA\JsonContent(type="array")
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server error",
 *         @OA\JsonContent(type="object")
 *     )
 * )
 */
Flight::route('GET /customers/search/@last_name', function($last_name) {
    Flight::json(Flight::customerService()->searchCustomersByLastName($last_name));
});

/**
 * @OA\Post(
 *     path="/customers",
 *     summary="Create a new customer",
 *     tags={"Customers"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="user_id", type="integer"),
 *             @OA\Property(property="first_name", type="string"),
 *             @OA\Property(property="last_name", type="string"),
 *             @OA\Property(property="phone", type="integer"),
 *             @OA\Property(property="email", type="string", format="email")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Customer created successfully",
 *         @OA\JsonContent(type="object")
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input",
 *         @OA\JsonContent(type="object")
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server error",
 *         @OA\JsonContent(type="object")
 *     )
 * )
 */
Flight::route('POST /customers', function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::customerService()->addCustomer($data));
});

/**
 * @OA\Patch(
 *     path="/customers/{id}",
 *     summary="Update a customer",
 *     tags={"Customers"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Customer ID",
 *         @OA\Schema(type="integer", format="int64")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="user_id", type="integer"),
 *             @OA\Property(property="first_name", type="string"),
 *             @OA\Property(property="last_name", type="string"),
 *             @OA\Property(property="phone", type="integer"),
 *             @OA\Property(property="email", type="string", format="email")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Customer updated successfully",
 *         @OA\JsonContent(type="object")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Customer not found",
 *         @OA\JsonContent(type="object")
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server error",
 *         @OA\JsonContent(type="object")
 *     )
 * )
 */
Flight::route('PATCH /customers/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::customerService()->updateCustomer($id, $data));
});

/**
 * @OA\Delete(
 *     path="/customers/{id}",
 *     summary="Delete a customer",
 *     tags={"Customers"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Customer ID",
 *         @OA\Schema(type="integer", format="int64")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Customer deleted successfully"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Customer not found",
 *         @OA\JsonContent(type="object")
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server error",
 *         @OA\JsonContent(type="object")
 *     )
 * )
 */
Flight::route('DELETE /customers/@id', function($id) {
    Flight::customerService()->deleteCustomer($id);
});
?>
