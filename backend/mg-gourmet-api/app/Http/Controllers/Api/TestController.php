<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function products()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Products endpoint funcionando',
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Produto Teste',
                    'description' => 'Descrição do produto teste',
                    'price' => 29.99,
                    'image' => null,
                    'user_id' => 1
                ]
            ]
        ]);
    }
}