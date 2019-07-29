<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Comment;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::select('*')->orderBy('id','DESC')->paginate(4);
        $total = Post::all()->count();
        return view('posts.index', compact('posts','total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|max:255',
            'body'  => 'required',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = Auth::user()->id;
        $post->category_id = $request->categoryid;

        $post->save();

        $posts = Post::select('*')->orderBy('id','DESC')->paginate(4);
        $categories = Category::all();
        $total = Post::all()->count();

        // Post::create($validate);

        return view('posts.index', compact('posts','categories','total'))->with('success','Successfully Posted.');
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
        $categories = Category::all();
        $comments = Comment::select('*')->where('post_id',$id)->paginate(3);
        $totalcmt = Comment::select('*')->where('post_id',$id)->count();
        // print_r($totalcmt);die();
        return view('posts.view', compact('post','categories','comments','totalcmt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // print_r($id);die();
        $post = Post::find($id);
        $categories = Category::all();
        return view('posts.edit', compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'title' => 'required|max:255',
            'body'  => 'required',
        ]);

        $post = Post::find($id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = Auth::user()->id;
        $post->category_id = $request->categoryid;

        $post->save();

        $posts = Post::select('*')->orderBy('id','DESC')->paginate(4);
        $categories = Category::all();
        $total = Post::all()->count();

        // Post::create($validate);

        return view('posts.index', compact('posts','categories','total'))->with('success','Successfully Posted.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delpost = Post::find($id);
        $delpost->delete();

        return redirect('/posts')->with('info', 'Delete Successful.');
    }
}
