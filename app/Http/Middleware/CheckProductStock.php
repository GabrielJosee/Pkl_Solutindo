<?php

namespace App\Http\Middleware;

use App\Models\Product;
use Closure;
use Illuminate\Http\Request;

class CheckProductStock
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $productId = $request->route('product_id');
        $product_stock = $request->input('product_stock');
        $product = Product::findOrFail($productId);

        if ($product->stock < $product_stock) {
            return response()->json([
                'message' => 'Maaf, stok produk ini tidak mencukupi.'
            ], 400);
        }
        return $next($request);
    }
}
