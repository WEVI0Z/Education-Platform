<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Statistic;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    function main() {
        $documents = Document::query()->orderByDesc("id")->limit(5)->get();
        $stats = Statistic::query()->orderByDesc("id")->limit(5)->get();

        return view("main", compact("stats", "documents"));
    }
}
