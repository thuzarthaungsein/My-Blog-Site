@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
        <h3><a href="#">Posts</a></h3>
            @foreach($posts as $post)        
                    
            <div class="panel panel-success">
                <div class="panel-heading">{{ $post->title }}</div>

                <div class="panel-body">
                    {{ $post->body }}
                </div>

                <div class="panel-footer">
                    <small class="text-muted">Category &nbsp;
                        <span>{{ $post->created_at->diffForHumans() }}</span> 
                        <span class="pull-right">
                            <a href="{{ route('posts.edit', $post->id) }}"><span class="glyphicon glyphicon-edit"></span></a> &nbsp;
                            <a href="#"><span class="glyphicon glyphicon-trash" style="color:red;"></span></a>
                        </span>
                    </small>
                </div>
            </div>
            @endforeach
            {{ $posts->links() }}
        </div>
        
    </div>
</div>
@endsection