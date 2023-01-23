<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Task;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        ////////////// account
        $account = Account::create([
            "name" => 'account 1'
        ]);

        ////////////// projects
        $project1 = $account->projects()->create([
                "name" => 'Project 1',
                "price" => 99
        ]);
        $project2 = $account->projects()->create([
            "name" => 'Project 2',
            "price" => 100
        ]);
        $project3 = $account->projects()->create([
            "name" => 'Project 3',
            "price" => 101
        ]);

        ////////////// jobs
        $job1 = $project1->jobs()->create([
            "name" => 'Job 1',
            "amount" => 10000
        ]);
        $job2 = $project2->jobs()->create([
            "name" => 'Job 2',
            "amount" => 9000
        ]);
        $job3 = $project3->jobs()->create([
            "name" => 'Job 3',
            "amount" => 11000
        ]);

        ////////////// Tasks

        $job1->tasks()->createMany(
        [
            [
                "name" => 'task 1',
            ],
            [
                "name" => 'task 2',
            ],
        ]);
        $job2->tasks()->create([
            "name" => 'task 3',
        ]);
        $job3->tasks()->create([
            "name" => 'task 4',
        ]);

        return Task::whereHas('job.project' , function($project){
            $project->where('price' , '>' , '100');
        })->get();

        return view('home');
    }
}
