<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function showProfile()
    {
        $page = Page::where('slug', 'profile-perusahaan')
                    ->where('is_published', true)
                    ->firstOrFail();

        return view('pages.show', compact('page'));
    }
}