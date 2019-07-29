@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
        <h3>Posts <span class="badge">{{ $total }}</span></h3>
        @if(session('info'))
            <div class="alert alert-info">{{ session('info') }}</div>
        @endif  
      
            @foreach($posts as $post)     
            
            <div class="panel panel-info">
                <div class="panel-heading"><a href='{{ url("/posts/view/{$post->id}") }}'>{{ $post->title }}</a></div>

                <div class="panel-body">
                    {{ $post->body }}
                </div>

                <div class="panel-footer">
                    <small class="text-muted"><span class="text-danger">{{ $post->category->name }}</span> &nbsp;
                        <span>{{ $post->created_at->diffForHumans() }}</span> &nbsp;<i class="text-primary"> By {{ $post->user->name }}</i>
                        <span class="pull-right">
                            <a href='{{ url("/posts/view/{$post->id}") }}'><span class="badge">{{ count($post->comments) }}</span> comment/s</a>
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