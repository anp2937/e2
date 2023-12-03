<?php

namespace App\Controllers;

use App\Products;

class ProductsController extends Controller
{
    private $productsObj;

    /**
     *
     */
    public function __construct($app)
    {
        parent::__construct($app);
    }

    /**
     *
     */
    public function index()
    {
        $products = $this->app->db()->all('products');

        $productSaved = $this->app->old('productSaved');

        return $this->app->view('products/index', [
            'products' => $products,
            'productSaved' => $productSaved,
        ]);
    }

    /**
     *
     */
    public function show()
    {
        $sku = $this->app->param('sku');

        if (is_null($sku)) {
            $this->app->redirect('/products');
        }

        $productQuery = $this->app->db()->findByColumn('products', 'sku', '=', $sku);

        if (empty($productQuery)) {
            return $this->app->view('products/missing');
        } else {
            $product = $productQuery[0];
            $reviewsQuery = $this->app->db()->findByColumn('reviews', 'product_id', '=', $product['id']);
        }

        $reviewSaved = $this->app->old('reviewSaved');

        return $this->app->view('products/show', [
            'product' => $product,
            'reviewSaved' => $reviewSaved,
            'reviewsQuery' => $reviewsQuery,
        ]);
    }

    public function saveReview()
    {
        $this->app->validate([
            'sku' => 'required',
            'product_id' => 'required',
            'name' => 'required',
            'review' => 'required|minLength:200'
        ]);

        # If the above validation checks fail
        # The user is redirected back to where they came from (/product)
        # None of the code that follows will be executed

        $product_id = $this->app->input('product_id');
        $sku = $this->app->input('sku');
        $name = $this->app->input('name');
        $review = $this->app->input('review');


        $this->app->db()->insert('reviews', [
            'product_id' => $product_id,
            'name' => $name,
            'review' => $review,
        ]);

        return $this->app->redirect('/product?sku=' . $sku, ['reviewSaved' => true]);
    }

    public function newProduct()
    {
        return $this->app->view('products/new');
    }

    public function saveProduct()
    {
        $this->app->validate([
            'sku' => 'required',
            'name' => 'required',
            'description' => 'required|minLength:200'
        ]);

        $sku = $this->app->input('sku');
        $name = $this->app->input('name');
        $description = $this->app->input('description');


        $this->app->db()->insert('products', [
            'sku' => $sku,
            'name' => $name,
            'description' => $description,
        ]);

        return $this->app->redirect('/products', ['productSaved' => true]);
    }
}