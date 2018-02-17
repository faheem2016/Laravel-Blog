@extends('layouts.master')

@section('customCSS')
@endsection

@section('content')
    <div class="col-sm-8 blog-main">
        <h1>Publish a post</h1>

        <hr/>

        <form id="fileupload" method="POST" action="/posts" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>

            <div class="form-group">
                <label for="body">Body:</label>
                <textarea id="body" name="body" class="form-control"></textarea>
            </div>

            <div class="form-group file btn btn-lg btn-primary">
                Upload image:
                <input type="file" name="image" id="image"/>
            </div>

            <div class="form-group file btn btn-lg btn-primary">
                Upload video:
                <input type="file" name="video" id="video"/>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Publish</button>
            </div>

            @include('layouts.errors')
        </form>
    </div>
@endsection

@section('customJS')
@endsection