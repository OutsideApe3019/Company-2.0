<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use News;
use Log;

class PagesController extends Controller
{
    public function home() {
        return view('home');
    }

    public function settings() {
        return view('user.settings.index');
    }

    public function news() {
        $news = News::orderBy('id', 'desc')->paginate(5);

        return view('news.index', [
            'news' => $news,
        ]);
    }

    public function newsView(News $new) {
        return view('news.view', [
            'new' => $new,
        ]);
    }

    public function banned() {
        if(!Auth::check()) {
            return redirect()->route('home');
        }
        
        if(!Auth::user()->isBanned()) {
            return redirect()->route('home');
        }

        return abort(403, "Banned");
    }
}
