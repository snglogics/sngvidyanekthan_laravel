@extends('layouts.admin')

@section('title', 'Add Sports Award')
@section('breadcrumb-title', 'Achievements')
@section('breadcrumb-link', route('admin.achievements'))

@section('styles')
    <style>
        .form-container {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
            max-width: 850px;
            margin-left: auto;
            margin-right: auto;
            animation: fadeInUp 0.5s ease-in-out;
        }

        @keyframes fadeInUp {
            from {
                transform: translateY(30px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-header h2 {
            color: #007bff;
            font-weight: bold;
            font-size: 30px;
            margin-bottom: 10px;
            display: inline-block;
            position: relative;
        }

        .form-header h2::after {
            content: "";
            width: 60px;
            height: 4px;
            background-color: #007bff;
            position: absolute;
            left: 50%;
            bottom: -8px;
            transform: translateX(-50%);
            border-radius: 2px;
        }

        .form-label {
            font-weight: 600;
            color: #444;
            margin-bottom: 5px;
        }

        .form-control {
            border-radius: 8px;
            box-shadow: none;
            transition: box-shadow 0.3s ease;
        }

        .form-control:focus {
            box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
            border-color: #007bff;
        }

        .btn-primary {
            padding: 10px 30px;
            font-size: 16px;
            border-radius: 8px;
            background-color: #007bff;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .input-icon {
            position: relative;
        }

        .input-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .input-icon input,
        .input-icon textarea {
            padding-left: 40px;
        }

        .alert ul {
            margin-bottom: 0;
        }

        .text-center {
            margin-top: 20px;
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
@endsection

@section('content')
    <div class="container mt-4">
        <div class="form-container">
            <div class="form-header">
                <h2><i class="fas fa-trophy me-2 text-warning"></i>Add Sports Award</h2>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li><i class="fas fa-exclamation-circle text-danger me-1"></i> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.sports_awards.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3 input-icon">
                    <label for="title" class="form-label"><i class="fas fa-heading me-1"></i> Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Enter award title"
                        required>
                </div>

                <div class="mb-3 input-icon">
                    <label for="award_year" class="form-label"><i class="fas fa-calendar-alt me-1"></i> Award Year</label>
                    <input type="text" name="award_year" id="award_year" class="form-control" placeholder="Ex: 2025"
                        required>
                </div>

                <div class="mb-3 input-icon">
                    <label for="description" class="form-label"><i class="fas fa-align-left me-1"></i> Description</label>
                    <textarea name="description" id="description" class="form-control" rows="4"
                        placeholder="Write a brief description..."></textarea>
                </div>

                <div class="mb-3 input-icon">
                    <label for="image" class="form-label"><i class="fas fa-image me-1"></i> Upload Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>

                <div class="text-center">
                    <button type="submit" id="submitButton" class="btn btn-primary">
                        <i class="fas fa-plus-circle me-1"></i> Add Award
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('form').on('submit', function() {
            $('#submitButton')
                .html('<i class="fas fa-spinner fa-spin me-1"></i> Adding Data...')
                .prop('disabled', true);
        });
    </script>
@endsection
