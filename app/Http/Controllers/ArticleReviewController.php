<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleReviewController extends Controller
{
    public function create() {

        return view('review.create');
    }
}
