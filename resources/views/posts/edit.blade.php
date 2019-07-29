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
            {{$post->title}}
            <div class="panel panel-info">
                <div class="panel-heading">Edit Post</div>
                <div class="panel-body">
                    <form method="post">
                        @csrf
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $post->title }}">
                            <!-- <input type="hidden" name="id" class="form-control" value="{{ $post->id }}"> -->
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select name="categoryid" class="form-control">
                                @foreach($categories as $category)                                    
                                    <option value="{{ $category->id }}" @if($category->id == $post->category_id) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Body</label>
                            <textarea name="body" class="form-control" cols="30" rows="10">{{ $post->body }}</textarea>
                        </div>
                        <button class="btn btn-info">Edit Post</button>                       
                        <a href="{{ route('posts.index') }}" class="btn btn-default">Cancel</a>                       
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection