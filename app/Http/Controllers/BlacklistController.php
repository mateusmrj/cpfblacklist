<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlacklistController extends Controller
{
    
    /**
     * Requisições AJAX para consulta do cpf na blacklist
     *
     * @return \Illuminate\Http\Response
     */
    public function consulta(Request $request) {
        dd($request);
        
        return response()->json([
            $request
        ]);
    }
}
