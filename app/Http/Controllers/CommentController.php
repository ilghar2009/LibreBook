<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Token;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        //check token
            $token_code = $request->bearerToken();
            $token = Token::where('token', $token_code)->first();

            $user = $token->user;

        //check comment
            $request->validate([
                'comment' => ['required', 'min:3', 'max:100'],
                'blog_id' => ['required', 'exists:blogs,blog_id'],
            ]);

        //create new recorde

            $comment = new Comment();
            $comment->blog_id = $request->blog_id;
            $comment->user_id = $user->user_id;
            $comment->comment = $request->comment;

            $comment->save();

        return response()->json([
            'message' => 'Comment added successfully',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //get token
            $token_code = $request->bearerToken();
            $token = Token::where('token', $token_code)->first();

            $user = $token->user;

        //User Access Check
            if($user->user_id === $comment->user_id){

                //check request text
                    $request->validate([
                        'comment' => ['sometimes', 'min:3', 'max:100'],
                        'blog_id' => ['sometimes', 'exists:blogs,blog_id'],
                    ]);

                //update this recorde
                    $comment->update([
                        'blog_id' => $request->blog_id??$comment->blog_id,
                        'comment' => $request->comment??$comment->comment,
                    ]);

                return response()->json([
                    'message' => 'Comment updated successfully',
                ], 200);
            }

        return response()->json([
            'error' => 'Forbidden',
        ], 403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
