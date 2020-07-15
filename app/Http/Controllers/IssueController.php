<?php

namespace App\Http\Controllers;

use App\Issue;
use Validator;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show', 'all', 'updateCount']]);
    }

    public function index()
    {
        return response()->json(Issue::latest()->paginate(10)->toArray(), 200);
    }


    public function all()
    {
        return response()->json(Issue::all(), 200);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "title" => 'string|required',
            "slug" => 'string|required|unique:issues',
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

        $issue = Issue::create($request->only(
            'title',
            'slug',
            'description',
        ) + [
            "user_id" => \Auth::id(),
            "thumbnail" => $fileNameToStore,
            "pdf" => $pdfFileNameToStore
        ]);
        return response()->json($issue, 201);
    }

    public function show(Issue $issue)
    {
        return response()->json($issue, 200);
    }

    public function updateCount(Issue $issue)
    {
        $issue->increment('download_count');
        // return response()->json(['message' => "Download count added successfully"], 200);
        return response()->json($issue, 200);
    }

    public function update(Request $request, Issue $issue)
    {
        $issue->update($request->only('title', 'description', 'slug', 'status'));
        return response()->json($issue, 200);
    }

    public function destroy(Issue $issue)
    {
        unlink('public/uploads/thumbs/' . $issue->thumbnail);
        $issue->delete();
        return response()->json(['message' => 'Issue Deleted Successfully'], 200);
    }
}
