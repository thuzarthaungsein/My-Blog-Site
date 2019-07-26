@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
        @if(isset($post))
            {{$post->title}}
        @endif
        </div>
    </div>
</div>
@endsection