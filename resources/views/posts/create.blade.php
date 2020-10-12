@extends('layouts.app',['title'=> 'New Post'])

@section('content')
<div class="container">
    <div class="row">  
        <div class="col-md-6">
           @include('alert')
            <div class="card">
                <div class="card card-header">New Post</div>
                <div class="card-body">
                    
                        <form action="/posts/store" class="" method="POST" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            {{-- @include('posts.partials.form-control', ['post' => new App\post()]) --}}
                            @include('posts.partials.form-control', ['submit' => 'Create'] )

                            
                        </form>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@stop