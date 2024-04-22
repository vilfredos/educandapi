<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

class RankingController extends Controller
{
    //
    public function index()
    {
        $posts = DB::table('posts')->get();

        return view('ranking', ['posts' => $posts]);
    }

}
