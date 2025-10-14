<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Token;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    public function store(Request $request)
    {
        //validate
            $request->validate([
                'title' => 'required',
                'description' => 'required',
            ]);

        //get token then get user
            $token_c = $request->bearerToken();
            $token = Token::where('token', $token_c)->first();

            $user = $token->user;

        //create new recorde
            $category = new Category();
            $category->title = $request->title;
            $category->description = $request->description;
            $category->user_id = $user->user_id;
            $category->save();

        return response()->json([
            'message' => 'category create successfully',
            'category' => $category,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }


    public function update(Request $request, Category $category)
    {
        //validate requests
            $request->validate([
                'title' => ['sometimes', 'unique:categories,title'.$category->category_id],
                'description' => 'sometimes',
            ]);

        //get token
            $token_c = $request->bearerToken();
            $token = Token::where('token', $token_c)->first();

            $user = $token->user;

        //update category
            $category->update($request->all());

        return response()->json([
            'message' => 'category update successfully',
            'category' => $category,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
