<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <link href="{{ asset('frontend/css/admin.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" /> 
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
 
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"> 
    @yield('styles')
</head>
<body>
    <!-- Left Sidebar -->
    <div class="sidebar">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.home') }}">HomePage</a>
        <a href="{{ route('admin.home') }}">Media</a>

    </div>

    <!-- Main Content Area -->
    <div class="content">
    <nav style="background: #333; padding: 1rem;">
        <a href="{{ route('admin.dashboard') }}" style="color: white; margin-right: 1rem;">Dashboard</a>

        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: white;">
            Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </nav>

        <div style="padding: 2rem;">
            @yield('content')
        </div>
    </div>
<!-- Optional global JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    <script>
  AOS.init({
    duration: 1000,
    once: true,
  });
</script>

@yield('scripts')
  

</body>
</html>
