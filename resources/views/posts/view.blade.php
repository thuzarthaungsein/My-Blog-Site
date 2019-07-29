@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
      
            <div class="panel panel-info">
                <div class="panel-heading">{{ $post->title }}<a href='{{ url("/posts") }}' class="pull-right"><i>Back</i></a></div>

                <div class="panel-body">
                    {{ $post->body }}
                </div>

                <div class="panel-footer">
                    <small class="text-muted"><span class="text-danger">{{ $post->category->name }}</span> &nbsp;
                        <span>{{ $post->created_at->diffForHumans() }}</span> &nbsp; <i class="text-primary">By {{ $post->user->name }}</i>

                        @if($post->user_id == auth()->user()->id)
                            <span class="pull-right">
                                <a href='{{url("/posts/edit/{$post->id}")}}'><span class="glyphicon glyphicon-edit"></span></a> &nbsp;
                                <a href='{{url("/posts/delete/{$post->id}")}}'><span class="glyphicon glyphicon-trash" style="color:red;"></span></a>
                            </span>
                        @endif
                    </small>
                </div>
            </div>
            
            <div>
                <h4>Comments <span class="badge">{{ $totalcmt }}</span></h4>
                <hr/>
                @if(session('info'))
                    <div class="alert alert-success">
                        {{ session('info') }}
                    </div>
                @endif
                <!-- {{$comments}} -->
                @if(count($comments)>0)
                    @foreach($comments as $comment)
                        <div class="panel panel-default">
                            <div class="panel-body">
                                {{ $comment->comment }} <br/>
                            <!-- </div> -->
                            <!-- <div class="panel-footer"> -->
                                <small class="text-muted">
                                    {{ $comment->created_at->diffForHumans() }} <i class="text-primary">By {{ $comment->user->name }}</i> &nbsp; 
                                    <span class="text-danger">Reply</span>                                    
                                </small>
                                <span class="pull-right">
                                    <!-- <a href='{{url("/posts/edit/{$post->id}")}}'><span class="glyphicon glyphicon-edit"></span></a> &nbsp; -->
                                    @if(($comment->user_id == auth()->user()->id) || $post->user_id == auth()->user()->id)
                                    <a href='{{url("/comments/delete/{$comment->id}")}}'><span class="glyphicon glyphicon-trash" style="color:red;"></span></a>
                                    @endif
                                </span>
                            </div>
                        </div>
                    @endforeach
                @endif

                {{ $comments->links() }}

                @if(auth()->check())
                    <form method="post">
                        @csrf
                        <div class="form-group">
                            <textarea name="comment" class="form-control"></textarea>
                        </div>
                        
                        <button class="btn btn-info">Comment</button>
                    </form>
                @endif
            </div>
        </div>
        
    </div>
</div>
@endsection