<?php

namespace App\Jobs;

use App\Models\Mongo\Tweet;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;

class TwitterProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
    */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
    */
    public function handle()
    {
        try{
            $query =  request()->text ?? "t";
            $limit =  request()->tw_max ?? 10000;
            $query_limit =  $limit < 100 ? $limit : 100;
            $count = 0;
            $result_count = 1;
            $pagination_token = '';
            $url = request()->tw_url ?? "https://api.twitter.com/2/tweets/search/recent";
            Tweet::truncate();
            while ($count < $limit && $result_count > 0 ) {
                $response = Http::withToken('AAAAAAAAAAAAAAAAAAAAANhclQEAAAAAEqlEm0cTLZ8eu%2BMTVhajSgwmOaU%3DExODPy5hCIzh4YP8YyE45EFh5SuUTQdXqCNYBMASsGZTmCIDir')
                ->get($url . "?tweet.fields=created_at&max_results=$query_limit&query=$query".$pagination_token);
                StoreTweets::dispatch(@$response['data']);

                $pagination_token   = "&pagination_token=".@$response['meta']['next_token'];
                $result_count       = @$response['meta']['result_count'];
                $count             += $result_count;

            }
        }catch(Exception $ex){
            dd($ex);
        }
    }
}
