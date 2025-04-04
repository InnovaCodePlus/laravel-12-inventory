<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {



    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        // 1. GENERAR LA VENTA
        $sale = new Sale();

        $sale->client_id = $request->clientId;
        $sale->user_id = $request->userId;
        $sale->total = $request->total;

        $sale->save();
        
        // 2. ASOCIAR LOS DETALLES A LA VENTA
        $details = [];

        // 2.1 MAPEAR LOS DATOS
        foreach( $request->details as $product )
        {
            $details[] = [
                "sale_id" => $sale["id"],
                "product_name" => $product["productName"],
                "product_price" => $product["productPrice"],
                "product_id" => $product["productId"],
                "quantity" => $product["quantity"],
                "sub_total" => $product["subTotal"]
            ];
            
            
            // 2.2 VALIDAR EL STOCK
            $productStock = Product::find($product["productId"]);

            if( $product["quantity"] > $productStock["stock"] )
            {
                $sale->delete();

                return response()->json([
                    "message" => "No hay suficiente stock"
                ], 400);
            }
            
            // 2.3 ACTUALIZA EL STOCK
            $productStock["stock"] = $productStock["stock"] - $product["quantity"];
            $productStock->update();
        }

        // 3. GUARDAR LOS DETALLES
        DB::table("sale_details")->insert($details);

        
        return response()->json([
            "message" => "Venta realizada correctamente"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
}
