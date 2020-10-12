<?php

namespace App\Http\Controllers;

use App\{Category,post,Tag};
use App\Http\Requests\PostRequest;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\Assign;

class PostController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth')->except([
    //         'index',
    //         'show',
    //         ]);
    // }
    //
    public function show(post $post)
    {
        // $post = \DB::table('posts')->where('slug', $slug)->first();
        // $post = post::where('slug', $slug)->firstOrFail();

        // if (!$post) {
        //     abort(404);
        // } 
        // dd($post);   dapat gunakan compact post untuk teks yang sama dengan variable $variable post
        $posts = post::where('category_id', $post->category_id)->latest()->limit(6)->get();
        return view('posts.show', compact('post','posts'));
    }


    public function index()
    {
        // $posts = post::paginate(3);
        return view('posts.index', [
            'posts' => post::latest()->paginate(6),
        ]);
        // ['ini uang ke view', 'ini yang di controller']
    }

    

    public function create()
    {
        return view('posts.create', [
            'post' => new post(),
            'categories' => Category::get(),
            'tags' =>  Tag::get(),
            ]);
    }



    public function store(PostRequest $request)
    {
        // $post = new post;
        // $post->title = $request->title;  //the first post
        // $post->slug = \Str::slug($request->title); //the-first-post
        // $post->body = $request->body;
        // $post->save();

        // post::create([
        //     'title' => $request->title,
        //     'slug' => \Str::slug($request->title),
        //     'body' => $request->body,
        // ]);

        // $this->validate($request, [
        //     'title' => 'required|min:3|max:10',
        //     'body' => 'required',
        // ]); atau


        // $request->validate([
        //     'title' => 'required|min:3',
        //     'body' => 'required',
        // ]); atau
        // $post = $request->all();
        // $post['slug'] = \Str::slug($request->title);
        // post::create($post);

        // validate the vield

        //Validating img
        $request->validate([
            'thumbnail' => 'image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);
        //  dd(auth()->user()->posts());
        $attr = $request->all(); 
        // Assign title to the slug
        $slug=\Str::slug(request('title'));
        $attr['slug'] = $slug;
        
        $thumbnail = request()->file('thumbnail') ?  request()->file('thumbnail')->store("images/posts") : null;
        
        // if(request()->file('thumbnail'))
        // {
        //     $thumbnail = request()->file('thumbnail')>store("images/posts");
        // } else
        // {
        //     $thumbnail = null;
        // }
        // $thumbnail= request()->file('thumbnail');
        // $thumbnailUrl = $thumbnail->storeAs("images/posts", "{$slug}.{$thumbnail->extension()}");
       
        $attr['category_id'] = request('category');
        $attr['thumbnail'] = $thumbnail;
        // $attr['user_id'] = auth()->id();

        // //create new post
    //    $post = post::create($attr);
       $post = auth()->user()->posts()->create($attr);
       $post->tags()->attach(request('tags'));


        session()->flash('success', 'The post was created');

        // // return back();
        return redirect('posts');
    }




    public function edit(post $post)
    {
        return view('posts.edit',[
            'post' => $post,
            'categories' => Category::get(),
            'tags' =>  Tag::get(),
            ]);
    }



    public function update(post $post, PostRequest $request)
    {
        // dd($post);
        // $attr = request()->validate([
        //     'title' => 'required|min:3',
        //     'body' => 'required',
        // ]);
        $request->validate([
            'thumbnail' => 'image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);
        //  

        //memake policy dari postpolici
        $this->authorize('update', $post);
        if(request()->file('thumbnail'))
        {
            \Storage::delete($post->thumbnail);
            $thumbnail= request()->file('thumbnail')->store("images/posts");
        } else{
            $thumbnail= $post->thumbnail;
        }

        $attr = $request->all();
        $attr['category_id'] = request('category');
        $attr['thumbnail'] = $thumbnail;

        $post->update($attr);
        $post->tags()->sync(request('tags'));
        
        session()->flash('success', 'The post was updated');
        return redirect('posts');
        // post::updated($attr);
        // dd('updated');
    }

    
    public function destroy(post $post)
    {
        // if(auth()->user()->is($post->author)){
        //     $post->tags()->detach();
        //     $post->delete();
        //     session()->flash("success", "The post was destroy");
        //     return redirect('posts');
        // }
        // else
        $this->authorize('delete', $post);
        \Storage::delete($post->thumbnail);
        $post->tags()->detach();
        $post->delete();
        session()->flash("error", "It wasn't your post");
        return redirect('posts');
     
    }
}