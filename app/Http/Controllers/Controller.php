<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    function cleanCpf($cpf){
        $clean_cpf = strip_tags(htmlentities($cpf));
        $clean_cpf = preg_replace("/\D+/", "", $clean_cpf);
        return str_pad($clean_cpf, 11, "0", STR_PAD_LEFT);
    }
}
