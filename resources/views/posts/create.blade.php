@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">   
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif            
            <div class="panel panel-success">
                <div class="panel-heading">Add New Post</div>
                <div class="panel-body">
                    <form action="{{ route('posts.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Body</label>
                            <textarea name="body" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                        <button class="btn btn-success">Add Post</button>                       
                        <a href="{{ route('posts.index') }}" class="btn btn-default">Cancel</a>                       
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection