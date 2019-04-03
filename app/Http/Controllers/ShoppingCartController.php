<?php


namespace App\Http\Controllers;


use App\Models\ShoppingCart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShoppingCartController extends BaseController
{
    protected $shoppingCart;

    public function __construct(ShoppingCart $shoppingCart)
    {
        $this->shoppingCart = $shoppingCart;
    }

    public function index()
    {
        $shoppingCartProducts = $this->shoppingCart->all()->load('product')->toArray();

        $response = [
            'total' => 0
        ];

        foreach ($shoppingCartProducts as $shoppingCartProduct) {
            $response['total'] += $shoppingCartProduct['amount'] * $shoppingCartProduct['product']['value'];
            $response['items'][] = $shoppingCartProduct['product']['name'];
        }

        return $this->successResponse($response, 'The shopping cart has been returned successfully');
    }

    public function addProduct(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'product_id' => 'required',
            'amount'    => 'required'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Error of Validation', $validator->errors());
        }

        if (!$this->validateProductExistence($input['product_id'])) {
            return $this->errorResponse('The product does not exist');
        }

        if ($this->shoppingCart->where('product_id', $input['product_id'])->first() != null) {
            return $this->errorResponse('This product has already been inserted to the shopping cart', [], 400);
        }

        $shoppingCart = $this->shoppingCart->create($input);

        return $this->successResponse($shoppingCart->toArray(), 'Product added successfully to the shopping cart');
    }

    public function removeProduct($productId)
    {
        $this->shoppingCart->where('product_id', $productId)->delete();

        return $this->successResponse([], [], 204);
    }

    public function updateAmountOfProducts($productId, $amount)
    {
        if (!$this->validateProductExistence($productId)) {
            return $this->errorResponse('The product does not exist');
        }

        $shoppingCartProduct = $this->shoppingCart->where('product_id', $productId)->first();

        if ($shoppingCartProduct == null) {
            return $this->errorResponse('The Shopping Cart does not have this product');
        }

        $shoppingCartProduct->amount = $amount;
        $shoppingCartProduct->save();

        return $this->successResponse($shoppingCartProduct, 'Shopping Cart Updated Successfully');
    }

    private function validateProductExistence($productId)
    {
        return Product::find($productId) != null;
    }
}