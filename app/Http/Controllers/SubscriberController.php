<?php

namespace App\Http\Controllers;

use App\Subscriber;
use Illuminate\Http\Request;
use Validator;

class SubscriberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['store']]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => 'string|required',
            "mobile" => 'required|numeric',
            "email" => 'required|email',
            "address" => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $subscriber = Subscriber::create($request->only("name", "mobile", "email", "address"));
        return response()->json($subscriber, 201);
    }

    public function index()
    {
        return response()->json(Subscriber::all(), 200);
    }

    public function show(Subscriber $subscriber)
    {
        return response()->json($subscriber, 200);
    }

    public function update(Request $request, Subscriber $subscriber)
    {
        $subscriber->update($request->all());
        return response()->json(['message' => 'Updated Successfully'], 200);
    }

    public function delete(Subscriber $subscriber)
    {
        $subscriber->delete();
        return response()->json(['message' => 'Deleted Successfully'], 200);
    }
}
