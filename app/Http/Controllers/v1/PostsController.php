<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Filters\v1\PostsFilter;
use App\Http\Resources\v1\PostsCollection;
use App\Http\Resources\v1\PostsResource;
use App\Http\Requests\v1\StorePostRequest;
use App\Http\Requests\v1\UpdatePostRequest;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, Request $request)
    {
        // $request with query is in the format: {"userId": {"eq": "1"} }
        // for the url http://localhost:8000/api/v1/posts?userId[eq]=1
        
         $filter = new PostsFilter(); 
         $filteredQuery = $filter->transform($request); 

         //$filteredQuery becomes [["user_id", "=","1"],["title", "=","abc"]]
         //for url: http://localhost:8000/api/v1/posts?userId[eq]=2&title[eq]=Ea%20culpa%20doloremque%20laboriosam%20in%20quia%20illum.
         //posts filter items in [column, operator, value] format
        
        if(count($filteredQuery)==0) {           
            return new PostsCollection(Post::where('user_id', '=', $id)->get());
        }
        else {            
            return new PostsCollection(Post::where('user_id', '=', $id)->where($filteredQuery)->get());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        return new PostsResource(Post::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($userId, $postId)
    {
        return new PostsResource(Post::where('user_id', '=', $userId)
                                        ->where('id', '=', $postId)
                                        ->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $userId, $postId)
    {
        $post = Post::where('user_id', '=', $userId)
                        ->where('id', '=', $postId)
                        ->first();
        $post->update($request->all());        
    }
    public function delete($id)
    {
       
        $post = Post::findOrFail($id);
        return view('posts.delete', compact('post'));
        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($userId, $id)
    {
        Post::findOrFail($id)->delete(); 
        return 1;
    }
}
