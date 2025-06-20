@extends('layouts.layout')
@section('hero_title', 'PTA Members')
@section('content')
<style>
    .member-card {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 1rem;
        padding: 1.5rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: transform 0.3s ease;
    }

    .member-card:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    body {
        background: linear-gradient(135deg, #2b5876, #4e4376);
        color: white;
        min-height: 100vh;
    }

    .section-title {
        border-bottom: 2px solid #ffc107;
        display: inline-block;
        padding-bottom: 0.5rem;
        margin-bottom: 2rem;
    }
</style>

<div class="container py-5">
    {{-- <h2 class="text-center mb-5 section-title">PTA Members</h2> --}}

    @foreach($ptaMembers as $position => $members)
        <h4 class="text-center text-warning mt-5 mb-4">{{ $position }}</h4>
        <div class="row justify-content-center">
            @foreach($members as $member)
                <div class="col-10 col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center mb-4" data-aos="fade-up">
                    <div class="member-card text-center">
                        <img src="{{ $member->image_url }}" alt="{{ $member->name }}" class="rounded-circle mb-3" height="100" width="100" style="object-fit: cover;">
                        <h6 class="mb-0">{{ $member->name }}</h6>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>
@endsection

@section('scripts')
<!-- AOS JS -->
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true
    });
</script>
@endsection