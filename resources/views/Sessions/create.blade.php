@extends('layouts.master')

@section('content')

    <div class="col-sm-8">
        <h1>Sign In</h1>


        <form action="/login" method="POST">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="email">Email: </label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email Address">
            </div>

            <div class="form-group">
                <label for="password">Password: </label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Sign In</button>
            </div>

            @include('layouts.errors')
        </form>
    </div>
@endsection