<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Log;
use App\Blacklist;

class BlacklistController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }
    
    /**
     * Requisições AJAX para consulta do cpf na blacklist
     *
     * @return \Illuminate\Http\Response
     */
    public function consulta(Request $request) {
        $cpf = $this->cleanCpf($request["cpf"]);
        
        $block = Blacklist::where('cpf', $cpf)->where('status', 1)->get();
        if($block->isEmpty()){
            $situacao = [
                'cpf' => $cpf,
                'status' => 0,
                'description' => 'FREE'
            ];
        }else{
            $situacao = [
                'cpf' => $cpf,
                'status' => 1,
                'description' => 'BLOCK'
            ];
        }
            
        $logs = new Log;
        $logs->cpf=$cpf;
        $logs->consulta=1;
        $logs->save();
        
        return response()->json([
            'data' => $situacao
        ]);
    }
    
    /**
     * Requisições AJAX para adiciona cpf na blacklist
     *
     * @return \Illuminate\Http\Response
     */
    public function adicionar(Request $request){
        $cpf = $this->cleanCpf($request["cpf"]);
        
        $block = Blacklist::where('cpf', $cpf)->get();
        if($block->isEmpty()){
            $block->status = 1;
            $block->save();
        }else{
            $new_block = new Blacklist;
            $new_block->cpf = $cpf;
            $new_block->status = 1;
            $new_block->save();
        }
        
        
        return response()->json([
            'stats' => 1,
            'cpf'=>$cpf
        ]);
    }
    
    /**
     * Requisições AJAX para remove cpf da blacklist
     *
     * @return \Illuminate\Http\Response
     */
    public function remover(Request $request){
        $cpf = $this->cleanCpf($request["cpf"]);
        
        $block = Blacklist::where('cpf', $cpf)->first();
        $block->status = 0;
        $block->save();
        
        return response()->json([
            'stats' => 1,
            'cpf'=>$cpf
        ]);
    }
}
