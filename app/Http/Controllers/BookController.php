<?php

namespace App\Http\Controllers;

use App\Book;
use Validator;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show', 'updateCount']]);
    }

    public function index()
    {
        return response()->json(Book::latest()->paginate(10)->toArray(), 200);
    }

    public function updateCount(Book $book)
    {
        $book->increment('download_count');
        return response()->json($book, 200);
    }

    public function review(Request $request, Book $book)
    {
        $book->review->create([
            'user_id' => \Auth::id(),
            ''
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "title" => 'string|required',
            "slug" => 'string|required|unique:books',
            "description" => 'string',
            "pdf" => 'required|mimes:pdf',
            "thumbnail" => 'required|image',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if ($request->hasFile('thumbnail')) {
            $filenameWithExt = $request->file('thumbnail')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('thumbnail')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('thumbnail')->storeAs('public/uploads/thumbs', $fileNameToStore);
        } else {
            $fileNameToStore = 'thumb.png';
        }

        if ($request->hasFile('pdf')) {
            $pdfFilenameWithExt = $request->file('pdf')->getClientOriginalName();
            $pdfFilename = pathinfo($pdfFilenameWithExt, PATHINFO_FILENAME);
            $pdfExtension = $request->file('pdf')->getClientOriginalExtension();
            $pdfFileNameToStore = $pdfFilename . '_' . time() . '.' . $pdfExtension;
            $pdfPath = $request->file('pdf')->storeAs('public/uploads/pdf', $pdfFileNameToStore);
        } else {
            $pdfFileNameToStore = 'thumb.pdf';
        }

        $book = Book::create($request->only('title', 'slug', 'description') + [
            "user_id" => \Auth::id(),
            "thumbnail" => $fileNameToStore,
            "pdf" => $pdfFileNameToStore
        ]);
        return response()->json($book, 201);
    }

    public function show(Book $book)
    {
        return response()->json($book, 200);
    }

    public function update(Request $request, Book $book)
    {
        $book->update($request->only('title', 'description', 'slug', 'status'));
        return response()->json($book, 200);
    }

    public function destroy(Book $book)
    {
        unlink('public/uploads/thumbs/' . $book->thumbnail);
        unlink('public/uploads/pdf/' . $book->pdf);
        $book->delete();
        return response()->json(['message' => 'Issue Deleted Successfully'], 200);
    }
}
