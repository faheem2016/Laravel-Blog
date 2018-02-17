
<div class="container">
    <nav class="nav">
        @if(Auth::check())
            <h5 class="nav-link">{{ Auth::user()->name }}</h5>
        @endif
        <a class="nav-link" href="/">Home</a>
        @if(!Auth::check())
            <a class="nav-link" href="/login">Login</a>
            <a class="nav-link" href="/register">Register</a>
        @endif
        @if(Auth::check())
            <a class="nav-link " href="/posts/create">{{ "Create Post" }}</a>
            <a class="nav-link ml-auto" href="/logout">{{ "Logout" }}</a>
        @endif
    </nav>
</div>


