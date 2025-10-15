<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Token;
use Illuminate\Http\Request;

class BlogController extends Controller
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
        //get token and then user
            $token_c = $request->bearerToken();
            $token = Token::where('token', $token_c)->first();

            $user = $token->user;

        //check user available
            if(!$token->is_activity)
                return response()->json([
                   'error' => 'Forbidden',
                ], 403);

//        $blog = Blog::creating([
//            'category_id' => $request->category_id,
//            'meta_title' => $request->title,
//            'meta_description' => $request->description,
//            'user_id' => $user->user_id,
//            'age' => $request->age,
//            'pdf_file' => ,
//            'contents',
//            'role' =>,
//        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
