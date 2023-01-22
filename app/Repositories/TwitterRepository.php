<?php
namespace App\Repositories;

use App\Interfaces\BaseInterface;
use App\Interfaces\TwitterInterface;
use App\Models\Mongo\Tweet;
use Yajra\DataTables\DataTables;

class TwitterRepository implements TwitterInterface
{
    protected $model;
    public function __construct(Tweet $model)
    {
        $this->model =$model;
    }

    public function all(array $columns=['*'],array $relations=[],array $where=[],array $filter=[])
    {
        return $this->model->where($where)->with($relations)->get($columns);
    }

    public function data($request){
        $products = Tweet::orderBy('created_at','desc')->take(20)->get();
        return DataTables::of($products)
        ->editColumn('user_id',function($data){
            return @$data->user_id ?? '-';
        })
        ->editColumn('created_at',function($data){
            return date_create(@$data->created_at)->format('M, d-Y h:i A') ;
        })
        ->make(true);
        return $products;
    }


}
