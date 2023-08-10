<header>
    <h1>Video Upload Web App</h1>
  </header>
  <nav>
    <ul>
      @if (Auth::check())
      <li><a href="{{route('user-dashboard')}}">Dashboard</a></li>
      @else
      <li><a href="{{route('home')}}">Home</a></li>
      @endif
      @if (Auth::check())
      <li><a href="{{route('upload')}}">Post a Video</a></li>
      <li><a href="{{route('view-post')}}">View a Post</a></li>
      <li><a href="{{route('logout')}}">Logout</a></li>
      @else
       <li><a href="{{route('login')}}">Login</a></li> 
      <li><a href="{{route('register')}}">register</a></li>
     @endif
    </ul>
  </nav>