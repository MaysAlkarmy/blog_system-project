<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $postId)
    {
        $fields= Validator::make($request->all(),[
           'content' => 'required|string|max:500'
        ]);

        if($fields->fails()){
         return response()->json(['errors' => $fields->errors()], 422);
        }

        $comment= Comment::create([
         'user_id' => Auth::id(),
         'post_id' => $postId,
         'content' => $request->content
         ]);
        
          return response()->json([
            'message' => 'Comment added successfully',
            'comment' => $comment->load('user:id,name'),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $comment->delete();
        return response()->json(['message' => 'Comment deleted successfully']);
    
    }
}
