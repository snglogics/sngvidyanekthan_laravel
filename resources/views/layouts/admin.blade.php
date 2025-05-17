<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>

    {{-- External CSS --}}
    <link href="{{ asset('frontend/css/admin.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

    {{-- Custom Admin Styles --}}
    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
        }
        .sidebar a.active {
        background-color: #555;
        color: #ddd !important;
        font-weight: 600;
        border-left: 5px solid #ff9800;
        box-shadow: 2px 4px 15px rgba(0, 0, 0, 0.3);
    }
        .sidebar {
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            background-color: #333;
            padding: 20px;
            box-shadow: 5px 0 15px rgba(0, 0, 0, 0.2);
            color: #fff;
            overflow-y: auto;
        }
        .sidebar a {
            color: #fff;
            font-weight: 500;
            font-size: 16px;
            padding: 15px;
            display: block;
            border-radius: 8px;
            margin-bottom: 10px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .sidebar a:hover {
            background-color: #444;
            color: #ddd;
            box-shadow: 2px 4px 10px rgba(0, 0, 0, 0.3);
        }
        .sidebar a.active {
            background-color: #555;
            color: #ddd;
            font-weight: 600;
            border-left: 5px solid #ff9800;
        }
        .sidebar .sidebar-header {
            font-size: 20px;
            font-weight: bold;
            color: #f7a600;
            margin-bottom: 20px;
            text-align: center;
        }
        .content {
            margin-left: 270px;
            padding: 20px;
            background-color: #f9fafc;
            min-height: 100vh;
        }
        .navbar {
            background-color: #555;
            padding: 15px 30px;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            margin-bottom: 20px;
        }
        .navbar a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            margin-right: 20px;
        }
        .navbar a:hover {
            color: #ff9800;
            text-decoration: underline;
        }
        .sidebar .menu-icon {
            margin-right: 10px;
        }
        .logout-link {
            background-color: #ff5722;
            padding: 8px 15px;
            border-radius: 8px;
            color: #fff;
            transition: all 0.3s ease;
        }
        .logout-link:hover {
            background-color: #e64a19;
            color: #fff;
        }
    </style>

    @yield('styles')
</head>
<body>

{{-- Sidebar --}}
<div class="sidebar">
    <div class="sidebar-header">
        <i class="fa fa-cog"></i> Admin Panel
    </div>

    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="fa fa-tachometer-alt menu-icon"></i> Dashboard
    </a>
    <a href="{{ route('admin.home') }}" class="{{ request()->routeIs('admin.home') ? 'active' : '' }}">
        <i class="fa fa-home menu-icon"></i> HomePage
    </a>
    <a href="{{ route('admin.about') }}" class="{{ request()->routeIs('admin.about') ? 'active' : '' }}">
        <i class="fa fa-info-circle menu-icon"></i> About
    </a>
    <a href="{{ route('admin.academics') }}" class="{{ request()->routeIs('admin.academics') ? 'active' : '' }}">
        <i class="fa fa-graduation-cap menu-icon"></i> Academics
    </a>
    <a href="{{ route('admin.faculties') }}" class="{{ request()->routeIs('faculty.faculties') ? 'active' : '' }}">
        <i class="fa fa-chalkboard-teacher menu-icon"></i> Faculty
    </a>
    <a href="{{ route('admin.activities') }}" class="{{ request()->routeIs('admin.activities') ? 'active' : '' }}">
        <i class="fa fa-running menu-icon"></i> Activities
    </a>
    <a href="{{ route('admin.achievements') }}" class="{{ request()->routeIs('admin.achievements') ? 'active' : '' }}">
        <i class="fa fa-trophy menu-icon"></i> Achievements
    </a>
    <a href="{{ route('admin.galleries') }}" class="{{ request()->routeIs('admin.galleries') ? 'active' : '' }}">
        <i class="fa fa-images menu-icon"></i> Gallery
    </a>
    <a href="{{ route('admin.studentlife') }}" class="{{ request()->routeIs('admin.student_life') ? 'active' : '' }}">
        <i class="fa fa-users menu-icon"></i> Student Life
    </a>
    <a href="{{ route('admin.event') }}" class="{{ request()->routeIs('admin.event') ? 'active' : '' }}">
        <i class="fa fa-calendar-alt menu-icon"></i> Events
    </a>
</div>


    {{-- Main Content Area --}}
    <div class="content">
        {{-- Navbar --}}
        <div class="navbar">
            <div>
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </div>
            <div>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-link">
                    <i class="fa fa-sign-out-alt"></i> Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>

        {{-- Page Content --}}
        <div>
            @yield('content')
        </div>
    </div>

    {{-- Optional Global JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
