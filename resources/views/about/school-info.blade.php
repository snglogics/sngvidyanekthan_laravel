@extends('layouts.layout')

@section('title', 'School Information')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

@endsection

@section('content')
<section class="pt-5 pb-5" style="background-color: #f0f4f8;">
    <div class="container">
        <h2 class="text-center fw-bold text-primary mb-5" data-aos="fade-down">School Information</h2>
        <div class="row g-4">
            @php
                $infos = [
                    ['SCHOOL NAME', 'SIVAGIRI VIDYA NIKETAN, VALMIKI HILLS ALUVA KL', 'fa-school'],
                    ['SCHOOL CODE', '75057', 'fa-code'],
                    ['ADDRESS', 'VALMIKI HILLS, THOTTUMUGHOM P.O.', 'fa-location-dot'],
                    ['AFFILIATION CODE', '930060', 'fa-id-badge'],
                    ['PRINCIPAL', 'MRS SHEEBA MANOJ MENON', 'fa-user-tie'],
                    ['PRINCIPAL\'S CONTACT', '7558996221', 'fa-phone'],
                    ['PRINCIPAL\'S EMAIL', 'svidyaprincipal@gmail.com', 'fa-envelope'],
                    ['RETIREMENT DATE', '29/05/2030', 'fa-calendar-check'],
                    ['SCHOOL PHONE', '0484-2632102', 'fa-phone-volume'],
                    ['SCHOOL EMAIL', 'svidyaaluva@yahoo.com', 'fa-envelope-open'],
                    ['WEBSITE', 'www.sivagirividyaniketan.edu.in', 'fa-globe'],
                    ['FAX', '0484-2626490', 'fa-fax'],
                    ['LANDMARK', 'THOTTUMUGHOM', 'fa-map-marker-alt'],
                    ['ESTABLISHED', '1986', 'fa-hourglass-start'],
                    ['AFFILIATION VALIDITY', '1991 TO 2027', 'fa-calendar-days'],
                    ['AFFILIATION STATUS', 'PROVISIONAL', 'fa-circle-check'],
                    ['TRUST NAME', 'Sree Narayana Dharma Sanghom Trust Sivagiri Mutt', 'fa-handshake'],
                    ['SOCIETY REGISTRATION NO.', '2/1103(ME TRICHUR)', 'fa-file-signature'],
                    ['NOC ISSUER', 'Gov of Kerala No.54164/N3/90/GEdn', 'fa-file-alt'],
                    ['NOC ISSUE DATE', '33485', 'fa-calendar-alt'],
                    ['SHIFT TYPE', 'MORNING', 'fa-clock'],
                    ['RUNNING CLASSES FROM', '1', 'fa-list-ol'],
                    ['SKILL SUBJECTS', 'YES', 'fa-briefcase'],
                    ['EXAM CENTER NO.', '7625', 'fa-school-flag'],
                ];
            @endphp

            @foreach($infos as [$label, $value, $icon])
                <div class="col-lg-4 col-md-6" data-aos="zoom-in">
                    <div class="info-card text-center h-100">
                        <div class="info-icon">
                            <i class="fas {{ $icon }}"></i>
                        </div>
                        <div class="info-label">{{ $label }}</div>
                        <div class="info-value">{{ $value }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 900, once: true });
</script>
@endsection
