<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        //Check request's
            $request->validate([
                'categories' => ['required', 'array'],
                'title' => 'required',
                'description' => 'required',
                'age' => ['required', 'integer', 'min:1'],
                'pdf' => ['sometimes', 'mimes:pdf', 'max:2048'],
                'contents' => ['sometimes', 'string'],
            ]);

        //if file exist upload
            if($request->file('pdf')->getSize()) {
                //Upload PDF
                $path = $request->file('pdf')->store('public', 'pdf');

                //get url
                $url = Storage::disk('public')->url($path);
            }

        //create new recorde
            $blog = Blog::create([
                'meta_title' => $request->title,
                'meta_description' => $request->description,
                'user_id' => $user->user_id,
                'age' => $request->age,
                'pdf_file' => $url??null,
                'contents' => $request->contents??null,
            ]);

        //category relationships
            $blog->categories()->syncWithoutDetaching($request->categories);

        return response()->json([
            'blog' => $blog,
            "message" => 'successfully create new recorde',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        //Get token and then user
            $token_c = $request->bearerToken();
            $token = Token::where('token', $token_c)->first();

            $user = $token->user;

        //check user available
            if(!$token->is_activity)
                return response()->json([
                    'error' => 'Forbidden',
                ], 403);

            if($blog->user_id === $user->user_id){

                //check validation request
                    $request->validate([
                        'categories' => ['sometimes', 'array'],
                        'title' => 'sometimes',
                        'description' => 'sometimes',
                        'age' => ['sometimes', 'integer', 'min:1'],
                        'pdf' => ['sometimes', 'mimes:pdf', 'max:2048'],
                        'contents' => ['sometimes', 'string'],
                    ]);

                //update this blog
                    $blog->update([
                        'meta_title' => $request->title,
                        'meta_description' => $request->description,
                        'user_id' => $user->user_id,
                        'age' => $request->age,
                        'pdf_file' => $url??null,
                        'contents' => $request->contents??null,
                    ]);

                //Category relationships
                    if(isset($request->categories))
                        $blog->categories()->syncWithoutDetaching($request->categories);

                return response()->json([
                    'blog' => $blog,
                    'message' => 'successfully updated recorde',
                ], 200);
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
