<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Statistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatisticsController extends Controller
{
    function open(Request $request) {
        $document = Document::query()->find($request->route("id"));

        $stat = Statistic::query()->create([
            "user_id" => Auth::user()->id,
            "document_id" => $document->id
        ]);

        return redirect(asset($document->path));
    }

    function show() {
        $title = "Просморт статистики";
        $stats = Statistic::query()->orderByDesc("id")->get();

        return view("admin.stats", compact("title", "stats"));
    }
}
