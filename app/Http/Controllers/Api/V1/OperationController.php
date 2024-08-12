<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Operation;
use App\Models\Product;
use App\Http\Requests\V1\StoreOperationRequest;
use App\Http\Requests\UpdateOperationRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\OperationResource;
use App\Http\Resources\V1\OperationCollection;
use App\Filters\V1\OperationFilter;

use Illuminate\Http\Request;
use DB;


class OperationController extends Controller
{
    public function __construct(
        protected OperationFilter $filter,
        protected Operation $model,
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

        $operations = $query->paginate(
            perPage: $request->query('per_page', 40),
        );

        return new OperationCollection($operations->appends($request->query()));
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
     * @param  \App\Http\Requests\V1\StoreOperationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOperationRequest $request)
    {
        $response = DB::transaction(function () use ($request) {
            $response = new OperationResource(Operation::create($request->all()));
            if ($request->type === 'I') {
                Product::where('id', $request->productId)->increment('quantity', $request->quantity);
            } else {
                Product::where('id', $request->productId)->decrement('quantity', $request->quantity);
            }

            return $response;
        });

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function show(Operation $operation)
    {
        return new OperationResource($operation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function edit(Operation $operation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOperationRequest  $request
     * @param  \App\Models\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOperationRequest $request, Operation $operation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Operation $operation)
    {
        //
    }
}
