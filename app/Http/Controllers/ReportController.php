<?php

namespace App\Http\Controllers;

use App\Book;
use App\Issue;
use App\Post;
use App\Subscriber;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $issueCount = Issue::count();
        $booksCount = Book::count();
        $postsCount = Post::count();
        $subscriberCount = Subscriber::count();
        return response()->json(compact('issueCount', 'booksCount', 'postsCount', 'subscriberCount'), 200);
    }
}
