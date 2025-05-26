@extends('layouts.layout')

@section('content')
    <div class="container">
        <h2 class="mb-4">PTA Members</h2>

        @foreach($ptaMembers as $position => $members)
            <h4 class="mt-4">{{ $position }}</h4>
            <div class="row">
                @foreach($members as $member)
                    <div class="col-md-3 text-center mb-4">
                        <img src="{{ $member->image_url }}" class="rounded-circle" height="100" width="100" style="object-fit: cover">
                        <p class="mt-2 mb-0">{{ $member->name }}</p>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
