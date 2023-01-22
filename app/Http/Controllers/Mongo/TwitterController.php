<?php

namespace App\Http\Controllers\Mongo;

use App\Http\Controllers\Controller;
use App\Interfaces\TwitterInterface;
use App\Jobs\TwitterProcess;
use App\Models\Mongo\Tweet;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TwitterController extends Controller
{
    private $TwitterInterface;
    public function __construct(TwitterInterface $TwitterInterface)
    {
        $this->TwitterInterface = $TwitterInterface;
    }
    public function index()
    {
        return view('twitter.index');
    }

    public function data(Request $request){
        return $this->TwitterInterface->data($request);
    }

    public function pullData(Request $request){
        TwitterProcess::dispatch();
        return redirect()->route('twitter.index')->with(['success' => 'Tweets Pulled Successfully']);
    }
}
