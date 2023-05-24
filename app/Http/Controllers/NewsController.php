<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use NewsComment;
use Auth;
use News;

class NewsController extends Controller
{
    public function newComment(News $new, Request $request) {
        $request->validate([
            'text' => ['required', 'max:500'],
        ]);

        NewsComment::create([
            'news_id' => $new->id,
            'user_id' => Auth::user()->id,
            'text' => $request->input('text'),
        ]);

        toastr()->success('Comment created successfully.');
        return redirect()->route('news.view', ['new' => $new->id]);
    }
}
