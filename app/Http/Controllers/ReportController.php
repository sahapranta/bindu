<?php

namespace App\Http\Controllers;

use App\Issue;
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
        $subscriberCount = Subscriber::count();
        return response()->json(['issueCount' => $issueCount, 'subscriberCount' => $subscriberCount], 200);
    }
}
