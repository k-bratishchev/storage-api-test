<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Product;
use App\Http\Requests\V1\StoreProductRequest;
use App\Http\Requests\V1\UpdateProductRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ProductResource;
use App\Http\Resources\V1\ProductCollection;
use App\Filters\V1\ProductsFilter;

use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct(
        protected ProductsFilter $filter,
        protected Product $model,
    ) {}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		$query = $this->model->query();
		$this->filter->transformQuery($query, $request);

        $includeOperations = $request->query('includeOperations');

        if ($includeOperations) {
            $query = $query->with('operations');
        }

        $products = $query->paginate(
            perPage: $request->query('per_page', 40),
        );



        return new ProductCollection($products->appends($request->query()));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\V1\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        return new ProductResource(Product::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $includeOperations = request()->query('includeOperations');

        if ($includeOperations) {
            $product = $product->loadMissing('operations');
        }

        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\V1\StoreOperationRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
    }
}
