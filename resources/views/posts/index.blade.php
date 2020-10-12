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
       <div class="col-md-7">
        @forelse( $posts as $post)
        <div class="card mb-4"> 
            {{-- <img class="card-img-top" src="{{ asset("storage/". $post->thumbnail)}}" alt=""> --}}
            {{-- <img class="card-img-top" src="{{ asset($post->takeImage())}}" alt=""> --}}
            @if($post->thumbnail)
                      <a href="{{ route('posts.show', $post->slug)}}">
                         <img style="height: 400px; object-fit:cover; object-position: center;" class="card-img-top" src="{{ $post->takeImage}}" alt="">
                         </a>
            @endif

            <div class="card-body">
            {{-- <a href="{{ route('posts.show', $post->slug)}}" class="text-secondary">
                    {{ $post->category->name}} --}}
                <div>
                    <a href="{{ route('categories.show', $post->category->slug)}}" class="text-secondary">
                       <small >  {{ $post->category->name}} - </small>
                    </a>
                    @foreach($post->tags as $tag)
                        <a href="{{ route('tags.show', $tag->slug)}}" class="text-secondary">
                            <small>  {{ $tag->name}}</small>
                        </a>
                    @endforeach
                </div>
                    <h5>
                        <a href="{{ route('posts.show', $post->slug)}}" class="card-title">
                            <div class="text-dark">{{$post->title}}</div>
                        </a>
                    </h5>

                    <div class="text-secondary my-3">{{Str::limit($post->body, 130)}}</div>

                <div class="d-flex justify-content-between align-items-center mt-2">
                    <div class="media align-items-center">                           
                        <img width="40" class="rounded-circle mr-3"  src="{{ $post->gravatar() }}" alt="">
                            <div class="media-body">
                                    <div>{{ $post->author->name}}</div>                
                            </div>
                     </div>
                    <div class="text-secondary">
                        <small>
                            Published on {{$post->created_at->format( "d F, Y")}} </small>
                    </div>               
                </div>
            </div>
            
            
            {{-- <div class="">       --}}
                
                {{-- <div class="">{{$post->created_at->diffForHumans()}}</div> --}}
                {{-- @if(auth()->user()->is($post->author)) --}}
                {{-- @can('update', $post) 
                    <a href="/posts/{{ $post->slug}}/edit" class="btn btn-sm btn-success" >Edit</a>             
                @endcan --}}
            {{-- </div>               --}}
            {{-- ganti bahasa en ke id di app/config/app.php --}}
        </div>      

            @empty
            <div class="col-md-6">
                <div class="alert alert-warning"> There are no posts.</div>
            </div>  
        @endforelse  
                
            </div>
         </div>

                {{$posts->links()}}

</div>

@stop