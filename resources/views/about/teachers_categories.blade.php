@extends('layouts.layout')

@section('title', 'Teachers by Department and Subject')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .filter-container {
            margin-bottom: 30px;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .filter-container select,
        .filter-container button {
            flex: 1;
            max-width: 200px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-weight: bold;
            cursor: pointer;
        }

        .filter-container button {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
        }

        .filter-container button:hover {
            background-color: #0056b3;
        }

        .teacher-card-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .teacher-card {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.6);
            overflow: hidden;
            transition: all 0.3s ease-in-out;
            display: flex;
            flex-direction: row;
            margin-bottom: 30px;
            width: 100%;
            max-width: 900px;
            margin: 15px auto;
            background: transparent;
        }

        .teacher-card img {
            width: 250px;
            height: 250px;
            border-radius: 15px 0 0 15px;
            object-fit: cover;
            transition: all 0.3s ease-in-out;
        }

        .teacher-card img:hover {
            transform: scale(1.05);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .teacher-card .card-body {
            padding: 20px;
            flex: 1;
        }

        .teacher-card .card-body h3 {
            color: #007bff;
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 24px;
        }

        .teacher-card .card-body h5 {
            color: #555;
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 18px;
        }

        .teacher-card .card-body p {
            color: #777;
            font-size: 16px;
            margin-bottom: 15px;
        }

        .teacher-card .details-list {
            list-style-type: none;
            padding: 0;
            margin-bottom: 20px;
        }

        .teacher-card .details-list li {
            margin-bottom: 8px;
            font-size: 14px;
            color: #555;
            display: flex;
            align-items: center;
        }

        .teacher-card .details-list li i {
            color: #007bff;
            margin-right: 15px;
            font-size: 20px;
        }

        .teacher-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .teacher-card .view-profile-btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 30px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
            display: inline-block;
            margin-top: 15px;
            font-size: 16px;
        }

        .teacher-card .view-profile-btn:hover {
            background-color: #0056b3;
            text-decoration: none;
        }

        .filter-container {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            background-color: #f8f9fa;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            align-items: end;
        }

        .filter-container select {
            padding-left: 2.5rem;
            background-repeat: no-repeat;
            background-position: 0.75rem center;
            background-size: 1rem;
            border-radius: 6px;
            min-width: 200px;
        }

        #department {
            background-image: url('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/icons/building.svg');
        }

        #subject {
            background-image: url('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/icons/book.svg');
        }

        .filter-container button {
            min-width: 120px;
        }
    </style>
    <style>
        .parallax-section {
            background-image: url('/frontend/images/parallel17.jpg');
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 60px 0;
            /* Optional: control space above and below */
            position: relative;
            overflow: hidden;
        }

        /* Optional overlay for better text readability */
        .parallax-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background: rgba(255, 255, 255, 0.4);
            /* Light overlay */
            z-index: 0;
        }

        .teacher-list-container {
            position: relative;
            z-index: 1;
        }
    </style>
@endsection
@section('hero_title', 'Categorized Teachers & Staffs')
@section('content')

    <div class="parallax-section">
        <section class="teacher-list-container">
            <div class="container">


                <!-- Filter Form -->
                <form id="filter-form" method="GET" action="{{ route('teachers.categorized') }}" class="filter-container">
                    <select name="department" id="department" onchange="document.getElementById('filter-form').submit()">
                        <option value="">All Departments</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department }}"
                                {{ request('department') == $department ? 'selected' : '' }}>
                                {{ $department }}
                            </option>
                        @endforeach
                    </select>

                    <select name="subject" id="subject" onchange="document.getElementById('filter-form').submit()">
                        <option value="">All Subjects</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject }}" {{ request('subject') == $subject ? 'selected' : '' }}>
                                {{ $subject }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit">Filter</button>
                </form>

                <div class="teacher-card-wrapper">
                    @forelse($teachers as $teacher)
                        <div class="teacher-card" data-aos="fade-up">
                            <img src="{{ $teacher->photo ?? asset('frontend/images/dummyhead.jpg') }}"
                                alt="{{ $teacher->name }}">

                            <div class="card-body">
                                <h3>{{ $teacher->name }}</h3>
                                <h5>{{ $teacher->designation }}</h5>
                                <ul class="details-list">
                                    {{-- <li><i class="fas fa-briefcase"></i> <strong>Experience:</strong> {{ $teacher->experience }} years</li> --}}
                                    <li><i class="fas fa-graduation-cap"></i> <strong>Qualification:</strong>
                                        {{ $teacher->qualification }}</li>
                                    <li><i class="fas fa-chalkboard-teacher"></i> <strong>Department:</strong>
                                        {{ $teacher->department }}</li>
                                    {{-- <li><i class="fas fa-book"></i> <strong>Subject:</strong> {{ $teacher->subject }}</li> --}}
                                </ul>
                                <!-- <a href="#" class="view-profile-btn">
                                                <i class="fas fa-eye"></i> View Profile
                                            </a> -->
                            </div>
                        </div>
                    @empty
                        <p>No teachers found.</p>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });
    </script>
@endsection
