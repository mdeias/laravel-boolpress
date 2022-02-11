<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(4);
        $categories = Category::all();
        return view('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'title' => 'required|max:255|min:2',
                'content' => 'required'
            ],
            [
                'title.required' => 'Il titolo è obbligatorio',
                'title.min' => 'Il titolo deve essere lungo minimo :min caratteri',
                'title.max' => 'Il titolo deve essere lungo massimo :max caratteri',
                'content.required' => 'Il contenuto è obbligatorio',
            ]
        );

        $data = $request->all();

        $new_post = new Post();
        $new_post->fill($data);
        $new_post->slug = Post::generateSlug($new_post->title);

        $new_post->save();
        return redirect()->route('admin.posts.show', $new_post);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        if($post){
            return view('admin.posts.show', compact('post'));
        }
        abort(404, 'Errore nella ricerca del post');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if($post){
            return view('admin.posts.edit', compact('post'));
        }

        abort(404, 'Post non presente nel db');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $request->validate(
            [
                'title' => 'required|max:255|min:2',
                'content' => 'required'
            ],
            [
                'title.required' => 'Il titolo è obbligatorio',
                'title.min' => 'Il titolo deve essere lungo minimo :min caratteri',
                'title.max' => 'Il titolo deve essere lungo massimo :max caratteri',
                'content.required' => 'Il contenuto è obbligatorio',
            ]
        );

        $form_data = $request->all();

        if($form_data['title'] != $post->title ){

            $form_data['slug'] = Post::generateSlug($form_data['title']);
        }

        $post->update($form_data);

        return redirect()->route('admin.posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('deleted', 'Post eliminato in modo corretto');
    }
}
