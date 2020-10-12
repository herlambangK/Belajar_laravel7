@extends('layouts.app')

@section('content')
<div class="container">
    {{-- @if ($posts->count()) --}}
        <div class="">
            <div> 
                @isset($category)
            <h4> Category: {{ $category->name}}</h4>     
                @endisset

                @isset($tag)
                <h4> Tags: {{ $tag->name}}</h4>
                    @endisset

                    @if(!isset($tag) && (!isset($category)))
                    <h4> All Posts </h4>
                    @endif         
            </div>
            
            <div>
                @if(Auth::check())
                  <a href="{{ route('posts.create')}}" class="btn btn-primary"> New Post</a>
                  @else
                  <a href="{{ route('login')}}" class="btn btn-primary"> Login to create new post </a>
             @endif
            </div>
            <hr>
        </div>
        
        
       
   <div class="row">
       <div class="col-md-6">
        @forelse( $posts as $post)
        <div class="card mb-4"> 
            {{-- <img class="card-img-top" src="{{ asset("storage/". $post->thumbnail)}}" alt=""> --}}
            {{-- <img class="card-img-top" src="{{ asset($post->takeImage())}}" alt=""> --}}
            @if($post->thumbnail)
                <img style="height: 320px; object-fit:cover; object-position: center;" class="card-img-top" src="{{ $post->takeImage}}" alt="">
            @endif


            <div class="card-body">
                <div class="card-title">
                    <div>{{$post->title}}</div>
                    <div class="text-secondary">Author {{ $post->author->name }}</div>
                </div>
                <div class="">{{Str::limit($post->body, 100)}}</div> 
                <a href=" /posts/{{ $post->slug}}">Read More</a>
            </div>
            
            
            <div class="card-footer d-flex justify-content-between">      
                <div class="">Published on {{$post->created_at->format( "d F, Y")}}</div>
                {{-- <div class="">{{$post->created_at->diffForHumans()}}</div> --}}
                {{-- @if(auth()->user()->is($post->author)) --}}
                @can('update', $post) 
                    <a href="/posts/{{ $post->slug}}/edit" class="btn btn-sm btn-success" >Edit</a>             
                @endcan
            </div>              
            {{-- ganti bahasa en ke id di app/config/app.php --}}
        </div>      

            @empty
            <div class="col-md-6">
                <div class="alert alert-warning"> There are no posts.</div>
            </div>  
        @endforelse  
    
       </div>
   </div>
                   
            </div>
         </div>
        <div class="d-flex justify-content-center">
                <div class="">{{$posts->links()}}</div>
        </div>
        {{-- @else --}}
        
      {{-- @endif --}}
</div>

@stop