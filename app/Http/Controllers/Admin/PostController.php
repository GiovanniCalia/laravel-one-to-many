<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{

    protected $validators = [
        'title'          => 'required|max:255',
        'creator'        => 'required|max:50',
        'description'    => 'required',
        'image'          => 'nullable|url|max:255',
        'date_creation'  => 'required|max:20',
    ];

     private function getValidators($model) {
        return [
            'title'          => 'required|max:255',
            'slug' => [
                'required',
                Rule::unique('posts')->ignore($model),
                'max:255'
            ],
            'creator'        => 'required|max:50',
            'description'    => 'required',
            'image'          => 'nullable|url|max:255',
            'date_creation'  => 'required|max:20',
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(30);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate($this->getValidators(null));
       /* $request->validate([
            'title'          => 'required|max:255',
            'slug'           => 'required|unique:posts|max:255',
            'creator'        => 'required|max:50',
            'description'    => 'required',
            'image'          => 'nullable|url|max:255',
            'date_creation'  => 'required|max:20',
        ]);*/

        $save = Post::create($request->all());
        return redirect()->route('admin.posts.show', $save->id); //id
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        /*$request->validate([
            'title'          => 'required|max:255',
            'slug'           => 'required|unique:posts|max:255', //Rule::unique('posts')->ignore($this->id)
            'creator'        => 'required|max:50',
            'description'    => 'required',
            'image'          => 'nullable|url|max:255',
            'date_creation'  => 'required|max:20',
        ]);*/

        $request->validate($this->getValidators($post));

        $post->update($request->all());

        return redirect()->route('admin.posts.show', $post->id);  //id
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        //return back();
        return redirect()->route('admin.posts.index');
    }
}
