<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Statistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DocumentsController extends Controller
{
    function showPanel() {
        $documents = Document::query()->orderByDesc("id")->limit(5)->get();

        $stats = Statistic::query()->orderByDesc("id")->limit(5)->get();

        $title = "Панель администратора";

        return view("admin.panel", compact("title", "documents", "stats"));
    }

    function showDocs() {
        $documents = Document::query()->orderByDesc("id")->get();

        $title = "Управление документами";

        return view("admin.documents", compact("title", "documents"));
    }

    function createDoc(Request $request) {
        if ($_POST) {
            $rules = [
                "name" => "required|unique:documents",
                "file" => "required|mimes:docx",
            ];

            $messages = [
                "name.required" => "Название обязательно",
                "file.required" => "Файл обязателен",
                "name.unique" => "Документ с таким названием уже существует",
                "file.mimes" => "Файл должен быть формата docx",
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            $validator->validate();

            $doc = $request->file("file")->store("public");

            Document::query()->create([
                "name" => $request->name,
                "path" => $doc,
                "category" => $request->category,
            ]);

            return redirect()->route("admin-docs")->with("message", "Документ был успешно создан");
        }

        $title = "Создание документа";

        return view("admin.create", compact("title"));
    }

    function delete(Request $request) {
        $document = Document::query()->find($request->route("id"));

        $document->delete();

        return redirect()->route("admin-docs")->with("message", "Документ был успешно удален");
    }

    function edit(Request $request) {
        $document = Document::query()->find($request->route("id"));

        if ($_POST) {
            $rules = [
                "name" => "required",
            ];

            $messages = [
                "name.required" => "Имя документа обязательно",
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            $validator->validate();

            $document->update([
                "name" => $request->name,
                "category" => $request->category,
            ]);

            return redirect()->route("admin-docs")->with("message", "Документ был успешно отредактирован");
        }

        $title = $document->name;

        return view("admin.edit", compact("title", "document"));
    }

    function show(Request $request) {
        $category = $request->route("category");

        $title = $category;

        $documents = Document::query()->where("category", "=", $category)->orderByDesc("id")->get();

        return view("documents.list", compact("documents", "title"));
    }

    function apiSearch(Request $request) {
        $category = $request->category;
        $target = $request->text;

        $documents = Document::query()->where("category", "=", $category)->where("name", "like", "%" . $target . "%")->orderByDesc("id")->get();

        return $documents;
    }
}
