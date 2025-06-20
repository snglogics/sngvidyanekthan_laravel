@extends('layouts.admin')
@section('content')
<div class="container">
    <h2>Kindergarten Sliders</h2>
    <a href="{{ route('admin.kinder-sliders.create') }}" class="btn btn-success mb-3">Add New</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Image</th>
                <th>Header</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sliders as $slider)
            <tr>
                <td><img src="{{ $slider->image_url }}" width="100"></td>
                <td>{{ $slider->header }}</td>
                <td>{{ $slider->description }}</td>
                <td>
                    <form action="{{ route('admin.kinder-sliders.destroy', $slider->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
