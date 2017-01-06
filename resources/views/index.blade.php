@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">搜索结果 ({{ $posts->count() }})</div>
                <div class="panel-body">
                    @foreach($posts as $post)
                        <div class="row">
                            <h2>{{ $post->title }}</h2>
                            <p>{{ $post->content }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
