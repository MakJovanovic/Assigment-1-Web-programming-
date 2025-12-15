<?php
/**
 * @OA\Get(
 *     path="/carts",
 *     summary="Get all carts",
 *     tags={"Carts"},
 *     @OA\Response(
 *         response=200,
 *         description="List of all carts",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="customer_id", type="integer", example=1),
 *                 @OA\Property(property="order_id", type="integer", example=1),
 *                 @OA\Property(property="status", type="integer", example=1, description="1 for active, 0 for inactive"),
 *                 @OA\Property(property="time", type="string", format="date-time", example="2024-01-15 10:30:00")
 *             )
 *         )
 *     ),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('GET /carts', function() {
    Flight::auth_middleware()->authorizeRoles([Roles::USER, Roles::ADMIN]);
    Flight::json(Flight::cartService()->getAllCarts());
});

/**
 * @OA\Get(
 *     path="/carts/{id}",
 *     summary="Get cart by ID",
 *     tags={"Carts"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Cart ID",
 *         @OA\Schema(type="integer", format="int64")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Cart details",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="customer_id", type="integer", example=1),
 *             @OA\Property(property="order_id", type="integer", example=1),
 *             @OA\Property(property="status", type="integer", example=1, description="1 for active, 0 for inactive"),
 *             @OA\Property(property="time", type="string", format="date-time", example="2024-01-15 10:30:00")
 *         )
 *     ),
 *     @OA\Response(response=404, description="Cart not found"),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('GET /carts/@id', function($id) {
    Flight::auth_middleware()->authorizeRoles([Roles::USER, Roles::ADMIN]);
    Flight::json(Flight::cartService()->getCartById($id));
});

/**
 * @OA\Get(
 *     path="/carts/customer/{customer_id}",
 *     summary="Get carts by customer ID",
 *     tags={"Carts"},
 *     @OA\Parameter(
 *         name="customer_id",
 *         in="path",
 *         required=true,
 *         description="Customer ID",
 *         @OA\Schema(type="integer", format="int64")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="List of carts for the customer",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="customer_id", type="integer", example=1),
 *                 @OA\Property(property="order_id", type="integer", example=1),
 *                 @OA\Property(property="status", type="integer", example=1, description="1 for active, 0 for inactive"),
 *                 @OA\Property(property="time", type="string", format="date-time", example="2024-01-15 10:30:00")
 *             )
 *         )
 *     ),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('GET /carts/customer/@customer_id', function($customer_id) {
    Flight::auth_middleware()->authorizeRoles([Roles::USER, Roles::ADMIN]);
    Flight::json(Flight::cartService()->getCartsByCustomer($customer_id));
});

/**
 * @OA\Get(
 *     path="/carts/order/{order_id}",
 *     summary="Get carts by order ID",
 *     tags={"Carts"},
 *     @OA\Parameter(
 *         name="order_id",
 *         in="path",
 *         required=true,
 *         description="Order ID",
 *         @OA\Schema(type="integer", format="int64")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="List of carts for the order",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="customer_id", type="integer", example=1),
 *                 @OA\Property(property="order_id", type="integer", example=1),
 *                 @OA\Property(property="status", type="integer", example=1, description="1 for active, 0 for inactive"),
 *                 @OA\Property(property="time", type="string", format="date-time", example="2024-01-15 10:30:00")
 *             )
 *         )
 *     ),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('GET /carts/order/@order_id', function($order_id) {
    Flight::auth_middleware()->authorizeRoles([Roles::USER, Roles::ADMIN]);
    Flight::json(Flight::cartService()->getCartsByOrder($order_id));
});

/**
 * @OA\Get(
 *     path="/carts/active",
 *     summary="Get all active carts",
 *     tags={"Carts"},
 *     @OA\Response(
 *         response=200,
 *         description="List of active carts",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="customer_id", type="integer", example=1),
 *                 @OA\Property(property="order_id", type="integer", example=1),
 *                 @OA\Property(property="status", type="integer", example=1, description="1 for active, 0 for inactive"),
 *                 @OA\Property(property="time", type="string", format="date-time", example="2024-01-15 10:30:00")
 *             )
 *         )
 *     ),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('GET /carts/active', function() {
    Flight::auth_middleware()->authorizeRoles([Roles::USER, Roles::ADMIN]);
    Flight::json(Flight::cartService()->getActiveCarts());
});

/**
 * @OA\Get(
 *     path="/carts/range/{from}/{to}",
 *     summary="Get carts by time range",
 *     tags={"Carts"},
 *     @OA\Parameter(
 *         name="from",
 *         in="path",
 *         required=true,
 *         description="Start date/time",
 *         @OA\Schema(type="string", format="date-time")
 *     ),
 *     @OA\Parameter(
 *         name="to",
 *         in="path",
 *         required=true,
 *         description="End date/time",
 *         @OA\Schema(type="string", format="date-time")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="List of carts within the time range",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="customer_id", type="integer", example=1),
 *                 @OA\Property(property="order_id", type="integer", example=1),
 *                 @OA\Property(property="status", type="integer", example=1, description="1 for active, 0 for inactive"),
 *                 @OA\Property(property="time", type="string", format="date-time", example="2024-01-15 10:30:00")
 *             )
 *         )
 *     ),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('GET /carts/range/@from/@to', function($from, $to) {
    Flight::auth_middleware()->authorizeRoles([Roles::USER, Roles::ADMIN]);
    Flight::json(Flight::cartService()->getCartsByTimeRange($from, $to));
});

/**
 * @OA\Post(
 *     path="/carts",
 *     summary="Create a new cart",
 *     tags={"Carts"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             required={"customer_id"},
 *             @OA\Property(property="customer_id", type="integer", example=1),
 *             @OA\Property(property="order_id", type="integer", example=1),
 *             @OA\Property(property="status", type="integer", example=1, description="1 for active, 0 for inactive"),
 *             @OA\Property(property="time", type="string", format="date-time", example="2024-01-15 10:30:00")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Cart created successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="customer_id", type="integer", example=1),
 *             @OA\Property(property="order_id", type="integer", example=1),
 *             @OA\Property(property="status", type="integer", example=1, description="1 for active, 0 for inactive"),
 *             @OA\Property(property="time", type="string", format="date-time", example="2024-01-15 10:30:00")
 *         )
 *     ),
 *     @OA\Response(response=400, description="Invalid input"),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('POST /carts', function() {
    Flight::auth_middleware()->authorizeRoles([Roles::USER, Roles::ADMIN]);
    $data = Flight::request()->data->getData();
    Flight::json(Flight::cartService()->addCart($data));
});

/**
 * @OA\Patch(
 *     path="/carts/{id}",
 *     summary="Update a cart",
 *     tags={"Carts"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Cart ID",
 *         @OA\Schema(type="integer", format="int64")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="customer_id", type="integer", example=1),
 *             @OA\Property(property="order_id", type="integer", example=1),
 *             @OA\Property(property="status", type="integer", example=1, description="1 for active, 0 for inactive"),
 *             @OA\Property(property="time", type="string", format="date-time", example="2024-01-15 10:30:00")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Cart updated successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="customer_id", type="integer", example=1),
 *             @OA\Property(property="order_id", type="integer", example=1),
 *             @OA\Property(property="status", type="integer", example=1, description="1 for active, 0 for inactive"),
 *             @OA\Property(property="time", type="string", format="date-time", example="2024-01-15 10:30:00")
 *         )
 *     ),
 *     @OA\Response(response=404, description="Cart not found"),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('PATCH /carts/@id', function($id) {
    Flight::auth_middleware()->authorizeRoles([Roles::USER, Roles::ADMIN]);
    $data = Flight::request()->data->getData();
    Flight::json(Flight::cartService()->updateCart($id, $data));
});

/**
 * @OA\Delete(
 *     path="/carts/{id}",
 *     summary="Delete a cart",
 *     tags={"Carts"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Cart ID",
 *         @OA\Schema(type="integer", format="int64")
 *     ),
 *     @OA\Response(response=200, description="Cart deleted successfully"),
 *     @OA\Response(response=404, description="Cart not found"),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('DELETE /carts/@id', function($id) {
    Flight::auth_middleware()->authorizeRoles([Roles::USER, Roles::ADMIN]);
    Flight::cartService()->deleteCart($id);
});

?>
