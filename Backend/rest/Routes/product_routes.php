<?php
/**
 * @OA\Get(
 *     path="/products",
 *     summary="Get all products",
 *     tags={"Products"},
 *     @OA\Response(
 *         response=200,
 *         description="List of all products",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="user_id", type="integer", example=1),
 *                 @OA\Property(property="category_id", type="integer", example=1),
 *                 @OA\Property(property="name", type="string", example="Football Boots"),
 *                 @OA\Property(property="description", type="string", example="High-quality football boots"),
 *                 @OA\Property(property="image_type", type="string", example="image/jpeg"),
 *                 @OA\Property(property="image_base64", type="string", example="base64string..."),
 *                 @OA\Property(property="price", type="number", format="float", example=99.99),
 *                 @OA\Property(property="stock_quantity", type="integer", example=50)
 *             )
 *         )
 *     ),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('GET /products', function() {
   Flight::auth_middleware()->authorizeRoles([Roles::USER, Roles::ADMIN]);
   Flight::json(Flight::productService()->getAllProducts());
});

/**
 * @OA\Get(
 *     path="/products/{id}",
 *     summary="Get product by ID",
 *     tags={"Products"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Product ID",
 *         @OA\Schema(type="integer", format="int64")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Product details",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="category_id", type="integer", example=1),
 *             @OA\Property(property="name", type="string", example="Football Boots"),
 *             @OA\Property(property="description", type="string", example="High-quality football boots"),
 *             @OA\Property(property="image_type", type="string", example="image/jpeg"),
 *             @OA\Property(property="image_base64", type="string", example="base64string..."),
 *             @OA\Property(property="price", type="number", format="float", example=99.99),
 *             @OA\Property(property="stock_quantity", type="integer", example=50)
 *         )
 *     ),
 *     @OA\Response(response=404, description="Product not found"),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('GET /products/@id', function($id) {
   Flight::auth_middleware()->authorizeRoles([Roles::USER, Roles::ADMIN]);
   Flight::json(Flight::productService()->getProductById($id));
});

/**
 * @OA\Get(
 *     path="/products/category/{category_id}",
 *     summary="Get products by category",
 *     tags={"Products"},
 *     @OA\Parameter(
 *         name="category_id",
 *         in="path",
 *         required=true,
 *         description="Category ID",
 *         @OA\Schema(type="integer", format="int64")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="List of products in the category",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="user_id", type="integer", example=1),
 *                 @OA\Property(property="category_id", type="integer", example=1),
 *                 @OA\Property(property="name", type="string", example="Football Boots"),
 *                 @OA\Property(property="description", type="string", example="High-quality football boots"),
 *                 @OA\Property(property="image_type", type="string", example="image/jpeg"),
 *                 @OA\Property(property="image_base64", type="string", example="base64string..."),
 *                 @OA\Property(property="price", type="number", format="float", example=99.99),
 *                 @OA\Property(property="stock_quantity", type="integer", example=50)
 *             )
 *         )
 *     ),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('GET /products/category/@category_id', function($category_id) {
   Flight::auth_middleware()->authorizeRoles([Roles::USER, Roles::ADMIN]);
   Flight::json(Flight::productService()->getProductsByCategory($category_id));
});

/**
 * @OA\Get(
 *     path="/products/customer/{customer_id}",
 *     summary="Get products by customer ID",
 *     tags={"Products"},
 *     @OA\Parameter(
 *         name="customer_id",
 *         in="path",
 *         required=true,
 *         description="Customer ID",
 *         @OA\Schema(type="integer", format="int64")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="List of products for the customer",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="user_id", type="integer", example=1),
 *                 @OA\Property(property="category_id", type="integer", example=1),
 *                 @OA\Property(property="name", type="string", example="Football Boots"),
 *                 @OA\Property(property="description", type="string", example="High-quality football boots"),
 *                 @OA\Property(property="image_type", type="string", example="image/jpeg"),
 *                 @OA\Property(property="image_base64", type="string", example="base64string..."),
 *                 @OA\Property(property="price", type="number", format="float", example=99.99),
 *                 @OA\Property(property="stock_quantity", type="integer", example=50)
 *             )
 *         )
 *     ),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('GET /products/customer/@customer_id', function($customer_id) {
   Flight::auth_middleware()->authorizeRoles([Roles::USER, Roles::ADMIN]);
   Flight::json(Flight::productService()->getProductsByCustomer($customer_id));
});

/**
 * @OA\Get(
 *     path="/products/search/{keyword}",
 *     summary="Search products by keyword",
 *     tags={"Products"},
 *     @OA\Parameter(
 *         name="keyword",
 *         in="path",
 *         required=true,
 *         description="Search keyword",
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="List of products matching the keyword",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="user_id", type="integer", example=1),
 *                 @OA\Property(property="category_id", type="integer", example=1),
 *                 @OA\Property(property="name", type="string", example="Football Boots"),
 *                 @OA\Property(property="description", type="string", example="High-quality football boots"),
 *                 @OA\Property(property="image_type", type="string", example="image/jpeg"),
 *                 @OA\Property(property="image_base64", type="string", example="base64string..."),
 *                 @OA\Property(property="price", type="number", format="float", example=99.99),
 *                 @OA\Property(property="stock_quantity", type="integer", example=50)
 *             )
 *         )
 *     ),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('GET /products/search/@keyword', function($keyword) {
   Flight::auth_middleware()->authorizeRoles([Roles::USER, Roles::ADMIN]);
   Flight::json(Flight::productService()->searchProducts($keyword));
});

/**
 * @OA\Post(
 *     path="/products",
 *     summary="Create a new product",
 *     tags={"Products"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             required={"user_id", "category_id", "name", "price"},
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="category_id", type="integer", example=1),
 *             @OA\Property(property="name", type="string", example="Football Boots"),
 *             @OA\Property(property="description", type="string", example="High-quality football boots"),
 *             @OA\Property(property="image_type", type="string", example="image/jpeg"),
 *             @OA\Property(property="image_base64", type="string", example="base64string..."),
 *             @OA\Property(property="price", type="number", format="float", example=99.99),
 *             @OA\Property(property="stock_quantity", type="integer", example=50)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Product created successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="category_id", type="integer", example=1),
 *             @OA\Property(property="name", type="string", example="Football Boots"),
 *             @OA\Property(property="description", type="string", example="High-quality football boots"),
 *             @OA\Property(property="image_type", type="string", example="image/jpeg"),
 *             @OA\Property(property="image_base64", type="string", example="base64string..."),
 *             @OA\Property(property="price", type="number", format="float", example=99.99),
 *             @OA\Property(property="stock_quantity", type="integer", example=50)
 *         )
 *     ),
 *     @OA\Response(response=400, description="Invalid input"),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('POST /products', function() {
   Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
   $data = Flight::request()->data->getData();
   Flight::json(Flight::productService()->addProduct($data));
});

/**
 * @OA\Patch(
 *     path="/products/{id}",
 *     summary="Update a product",
 *     tags={"Products"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Product ID",
 *         @OA\Schema(type="integer", format="int64")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="category_id", type="integer", example=1),
 *             @OA\Property(property="name", type="string", example="Football Boots"),
 *             @OA\Property(property="description", type="string", example="High-quality football boots"),
 *             @OA\Property(property="image_type", type="string", example="image/jpeg"),
 *             @OA\Property(property="image_base64", type="string", example="base64string..."),
 *             @OA\Property(property="price", type="number", format="float", example=99.99),
 *             @OA\Property(property="stock_quantity", type="integer", example=50)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Product updated successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="category_id", type="integer", example=1),
 *             @OA\Property(property="name", type="string", example="Football Boots"),
 *             @OA\Property(property="description", type="string", example="High-quality football boots"),
 *             @OA\Property(property="image_type", type="string", example="image/jpeg"),
 *             @OA\Property(property="image_base64", type="string", example="base64string..."),
 *             @OA\Property(property="price", type="number", format="float", example=99.99),
 *             @OA\Property(property="stock_quantity", type="integer", example=50)
 *         )
 *     ),
 *     @OA\Response(response=404, description="Product not found"),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('PATCH /products/@id', function($id) {
   Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
   $data = Flight::request()->data->getData();
   Flight::json(Flight::productService()->updateProduct($id, $data));
});

/**
 * @OA\Delete(
 *     path="/products/{id}",
 *     summary="Delete a product",
 *     tags={"Products"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Product ID",
 *         @OA\Schema(type="integer", format="int64")
 *     ),
 *     @OA\Response(response=200, description="Product deleted successfully"),
 *     @OA\Response(response=404, description="Product not found"),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('DELETE /products/@id', function($id) {
   Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
   Flight::productService()->deleteProduct($id);
});

?>
