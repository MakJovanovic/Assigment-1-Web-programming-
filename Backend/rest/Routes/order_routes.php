<?php
/**
 * @OA\Get(
 *     path="/orders",
 *     summary="Get all orders",
 *     tags={"Orders"},
 *     @OA\Response(
 *         response=200,
 *         description="List of all orders",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="address", type="string", example="123 Main Street, City"),
 *                 @OA\Property(property="total_amount", type="number", format="float", example=199.99),
 *                 @OA\Property(property="order_date", type="string", format="date-time", example="2024-01-15 10:30:00")
 *             )
 *         )
 *     ),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('GET /orders', function() {
    Flight::auth_middleware()->authorizeRoles([Roles::USER, Roles::ADMIN]);
    Flight::json(Flight::orderService()->getAllOrders());
});

/**
 * @OA\Get(
 *     path="/orders/{id}",
 *     summary="Get order by ID",
 *     tags={"Orders"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Order ID",
 *         @OA\Schema(type="integer", format="int64")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order details",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="address", type="string", example="123 Main Street, City"),
 *             @OA\Property(property="total_amount", type="number", format="float", example=199.99),
 *             @OA\Property(property="order_date", type="string", format="date-time", example="2024-01-15 10:30:00")
 *         )
 *     ),
 *     @OA\Response(response=404, description="Order not found"),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('GET /orders/@id', function($id) {
    Flight::auth_middleware()->authorizeRoles([Roles::USER, Roles::ADMIN]);
    Flight::json(Flight::orderService()->getOrderById($id));
});

/**
 * @OA\Get(
 *     path="/orders/amount/{amount}",
 *     summary="Get orders above a certain amount",
 *     tags={"Orders"},
 *     @OA\Parameter(
 *         name="amount",
 *         in="path",
 *         required=true,
 *         description="Minimum order amount",
 *         @OA\Schema(type="number", format="float")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="List of orders above the specified amount",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="address", type="string", example="123 Main Street, City"),
 *                 @OA\Property(property="total_amount", type="number", format="float", example=199.99),
 *                 @OA\Property(property="order_date", type="string", format="date-time", example="2024-01-15 10:30:00")
 *             )
 *         )
 *     ),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('GET /orders/amount/@amount', function($amount) {
    Flight::auth_middleware()->authorizeRoles([Roles::USER, Roles::ADMIN]);
    Flight::json(Flight::orderService()->getOrdersAboveAmount($amount));
});

/**
 * @OA\Get(
 *     path="/orders/date/{date}",
 *     summary="Get orders by date",
 *     tags={"Orders"},
 *     @OA\Parameter(
 *         name="date",
 *         in="path",
 *         required=true,
 *         description="Order date (YYYY-MM-DD format)",
 *         @OA\Schema(type="string", format="date")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="List of orders for the specified date",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="address", type="string", example="123 Main Street, City"),
 *                 @OA\Property(property="total_amount", type="number", format="float", example=199.99),
 *                 @OA\Property(property="order_date", type="string", format="date-time", example="2024-01-15 10:30:00")
 *             )
 *         )
 *     ),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('GET /orders/date/@date', function($date) {
    Flight::auth_middleware()->authorizeRoles([Roles::USER, Roles::ADMIN]);
    Flight::json(Flight::orderService()->getOrdersByDate($date));
});

/**
 * @OA\Get(
 *     path="/orders/latest",
 *     summary="Get latest orders",
 *     tags={"Orders"},
 *     @OA\Parameter(
 *         name="limit",
 *         in="query",
 *         required=false,
 *         description="Number of orders to return",
 *         @OA\Schema(type="integer", default=10)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="List of latest orders",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="address", type="string", example="123 Main Street, City"),
 *                 @OA\Property(property="total_amount", type="number", format="float", example=199.99),
 *                 @OA\Property(property="order_date", type="string", format="date-time", example="2024-01-15 10:30:00")
 *             )
 *         )
 *     ),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('GET /orders/latest', function() {
    Flight::auth_middleware()->authorizeRoles([Roles::USER, Roles::ADMIN]);
    $limit = Flight::request()->query->limit ?? 10;
    Flight::json(Flight::orderService()->getLatestOrders((int)$limit));
});

/**
 * @OA\Post(
 *     path="/orders",
 *     summary="Create a new order",
 *     tags={"Orders"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             required={"address", "total_amount"},
 *             @OA\Property(property="address", type="string", example="123 Main Street, City"),
 *             @OA\Property(property="total_amount", type="number", format="float", example=199.99),
 *             @OA\Property(property="order_date", type="string", format="date-time", example="2024-01-15 10:30:00")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order created successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="address", type="string", example="123 Main Street, City"),
 *             @OA\Property(property="total_amount", type="number", format="float", example=199.99),
 *             @OA\Property(property="order_date", type="string", format="date-time", example="2024-01-15 10:30:00")
 *         )
 *     ),
 *     @OA\Response(response=400, description="Invalid input"),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('POST /orders', function() {
    Flight::auth_middleware()->authorizeRoles([Roles::USER, Roles::ADMIN]);
    $data = Flight::request()->data->getData();
    Flight::json(Flight::orderService()->addOrder($data));
});

/**
 * @OA\Patch(
 *     path="/orders/{id}",
 *     summary="Update an order",
 *     tags={"Orders"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Order ID",
 *         @OA\Schema(type="integer", format="int64")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="address", type="string", example="123 Main Street, City"),
 *             @OA\Property(property="total_amount", type="number", format="float", example=199.99),
 *             @OA\Property(property="order_date", type="string", format="date-time", example="2024-01-15 10:30:00")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order updated successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="address", type="string", example="123 Main Street, City"),
 *             @OA\Property(property="total_amount", type="number", format="float", example=199.99),
 *             @OA\Property(property="order_date", type="string", format="date-time", example="2024-01-15 10:30:00")
 *         )
 *     ),
 *     @OA\Response(response=404, description="Order not found"),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('PATCH /orders/@id', function($id) {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $data = Flight::request()->data->getData();
    Flight::json(Flight::orderService()->updateOrder($id, $data));
});

/**
 * @OA\Delete(
 *     path="/orders/{id}",
 *     summary="Delete an order",
 *     tags={"Orders"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Order ID",
 *         @OA\Schema(type="integer", format="int64")
 *     ),
 *     @OA\Response(response=200, description="Order deleted successfully"),
 *     @OA\Response(response=404, description="Order not found"),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('DELETE /orders/@id', function($id) {
    Flight::auth_middleware()->authorizeRoles([Roles::USER, Roles::ADMIN]);
    Flight::orderService()->deleteOrder($id);
});

?>
