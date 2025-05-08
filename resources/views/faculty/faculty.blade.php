@extends('layouts.layout')

@section('title', 'Faculty Statistics')

@section('content')
<section class="pt-5 pb-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold text-primary mb-5" data-aos="fade-down">Faculty Statistics</h2>

        @if($facultyStat)
        <div class="row">
            @php
                $stats = [
                    ['TOTAL NUMBER OF TEACHERS', $facultyStat->total_teachers],
                    ['NUMBER OF PGTs', $facultyStat->pgts],
                    ['NUMBER OF TGTs', $facultyStat->tgts],
                    ['NUMBER OF PRTs', $facultyStat->prts],
                    ['NUMBER OF PETs', $facultyStat->pets],
                    ['NON-TEACHING STAFF', $facultyStat->non_teaching],
                    ['MANDATORY TRAINING QUALIFIED TEACHERS', $facultyStat->mandatory_training_teachers],
                    ['TRAININGS ATTENDED SINCE LAST YEAR', $facultyStat->trainings_attended],
                    ['SPECIAL EDUCATOR APPOINTED', $facultyStat->special_educator ? 'Yes' : 'No'],
                    ['COUNSELLOR APPOINTED', $facultyStat->counsellor_appointed ? 'Yes' : 'No'],
                    ['MANDATORY TRAINING COMPLETED', $facultyStat->mandatory_training_completed ? 'Yes' : 'No'],
                    ['NUMBER OF NTTs', $facultyStat->ntts ?? 'No'],
                ];
            @endphp

            @foreach($stats as [$label, $value])
            <div class="col-md-6 mb-4 " data-aos="fade-up">
                <div class="p-4 border rounded shadow-sm bg-white h-100">
                    <h6 class="text-secondary">{{ $label }}</h6>
                    <p class="fw-semibold fs-5">{{ $value }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-center text-danger">No data available.</p>
        @endif
    </div>
</section>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 800,
    once: true
  });
</script>
@endsection
