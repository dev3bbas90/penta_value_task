<?php
namespace App\Interfaces;

use Illuminate\Http\Request;

interface TwitterInterface{
    public function all(array $columns=['*'],array $relations=[],array $where=[],array $filter=[]) ;
    public function data(Request $request) ;
}
