<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\Product;
use App\Models\ProductRequestTransaction;
use App\Models\RequestTransaction;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Database\QueryException;

class RequestTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = RequestTransaction::with(['products', 'user', 'user.department'])->get();
        // dd($transactions);
        return view('requests.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->ajax())
        {
            $users = new UserCollection(User::with('department')->get());
            $products = new ProductCollection(Product::with('location')->get());
            return response()->json([
                "data_user"=>$users,
                "data_product"=>$products,
            ], 200);
        }else{
            return abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->products[0]['product_id'];
        try {
            $user = User::where("nik", $request->nik)->first();
            $productsJson = $request->products;
            $reqTransaction = RequestTransaction::create([
                "user_id"=>$user->id,
                "status"=>"process"
            ]);
            foreach ($productsJson as $key => $productJson) {
                $product = Product::find($productJson['product_id']);
                ProductRequestTransaction::create([
                    "product_id"=>$product->id,
                    "request_transaction_id"=>$reqTransaction->id,
                    "qty"=>$productJson['qty'],
                ]);
                $product->update([
                    "stock"=>($product->stock - (int)$productJson['qty'])
                ]);
                $product->save();
            }
            return response()->json([
                "msg"=>"success"
            ], 201);
        } catch (QueryException $e) {
            return response()->json([
                "msg"=>$e
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RequestTransaction  $requestTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(RequestTransaction $requestTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RequestTransaction  $requestTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestTransaction $requestTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RequestTransaction  $requestTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequestTransaction $requestTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RequestTransaction  $requestTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestTransaction $requestTransaction)
    {
        //
    }
}
