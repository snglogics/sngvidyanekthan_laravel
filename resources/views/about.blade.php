@extends('layouts.layout')
@section('content')
    
    
<section id="about-part" class="pt-65">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="section-title mt-50">
                        <h5>About us</h5>
                        <h2>Welcome to VidyaNikethan </h2>
                    </div> <!-- section title -->
                    <div class="about-cont">
    {{-- First 2 paragraphs always visible --}}
    <p>Knowledge, the pathway to freedom, can be attained only through education. Sivagiri Vidyaniketan stands unique by perceiving Guru’s ideal “Achieve freedom through education ” and with the motto “Dream…… Achieve….and Lead…..”</p>
    <p>Sivagiri Vidyaniketan is at the threshold of its Golden Jubilee in 2023. Commencing its glorious journey in 1973 as “Sadanam” under S N Charities and thereafter headed by Sree Narayana Dharma Sanghom Trust in 1987, the organization was renamed as Sivagiri Vidyaniketan in 1990. Its affiliation in 1992 , made the school the first and foremost one in Aluva to follow Central Board of Secondary Education syllabus. The year 2005 was fortunate to witness its illustrious upgradation to the Higher Secondary level.</p>

    {{-- Hidden content --}}
    <div id="more-content" style="display: none;">
    <div id="typed-text">
        <p>Since the day of establishment, Sivagiri Vidyaniketan has been maintaining its multilevel quality provided by supportive administration and devoted teachers. SVN has always been kept distinctive with an open-minded acceptance of booming technologies like smart classrooms and robotics in training its wards to cope up with the changing era.</p>
        <p>The success of the school has been evolved from its tireless endeavour to help the students climb the academic ladder on the firm footholds of ethical values and discipline. Our ultimate objective is to help in moulding the total personality of a child in the challenging world. 
        School name is Sivagiri Vidyanikethan.</p>
</div>
    </div>

    <a href="#" id="toggle-btn" class="main-btn mt-55" onclick="toggleMore(event)">Learn More</a>
</div>
                </div> <!-- about cont -->


                <div class="col-lg-6 offset-lg-1">
    <div class="about-event mt-50">
        <div class="event-title">
            <h3>Upcoming events</h3>
        </div> <!-- event title -->

        <div style="max-height: 300px; overflow-y: auto;">
            <ul class="list-unstyled">
                @forelse($upcomingEvent as $event)
                    <li class="mb-3">
                        <div class="singel-event">
                            <span><i class="fa fa-calendar"></i> {{ \Carbon\Carbon::parse($event->event_date)->format('d F Y') }}</span>
                            <a href="#"><h4>{{ $event->heading }}</h4></a>
                            <span><i class="fa fa-clock-o"></i> {{ $event->time_interval }}</span>
                            <span><i class="fa fa-map-marker"></i> {{ $event->venue }}</span>
                        </div>
                    </li>
                @empty
                    <li><p>No upcoming events.</p></li>
                @endforelse
            </ul>
        </div>
    </div> <!-- about event -->
</div>


        <div class="about-bg">
            <img src="frontend/images/bg-1.jpg" alt="About">
        </div>
    </section>
    
    <!--====== ABOUT PART ENDS ======-->
    
 
    @endsection
<!-- java script part -->

@section('scripts')
<script>
function toggleMore(event) {
    event.preventDefault();
    const moreContainer = document.getElementById('more-content');
    const toggleBtn = document.getElementById('toggle-btn');
    const typedTextEl = document.getElementById('typed-text');

    if (moreContainer.style.display === 'none') {
        moreContainer.style.display = 'block';
        toggleBtn.textContent = 'Show Less';

        // Reset content
        typedTextEl.innerHTML = '';

        // Add line breaks manually using <br><br>
        const fullText = `Since the day of establishment, Sivagiri Vidyaniketan has been maintaining its multilevel quality provided by supportive administration and devoted teachers. SVN has always been kept distinctive with an open-minded acceptance of booming technologies like smart classrooms and robotics in training its wards to cope up with the changing era.\n\nThe success of the school has been evolved from its tireless endeavour to help the students climb the academic ladder on the firm footholds of ethical values and discipline. Our ultimate objective is to help in moulding the total personality of a child in the challenging world. School name is Sivagiri Vidyanikethan.`;

        // Replace newlines with <br> tags
        const htmlText = fullText.replace(/\n\n/g, '<br><br>').replace(/\n/g, '<br>');

        let index = 0;

        const interval = setInterval(() => {
            if (index < htmlText.length) {
                const char = htmlText[index];
                if (char === '<') {
                    // if start of a tag, skip to end of tag
                    const end = htmlText.indexOf('>', index);
                    typedTextEl.innerHTML += htmlText.slice(index, end + 1);
                    index = end + 1;
                } else {
                    typedTextEl.innerHTML += char;
                    index++;
                }
            } else {
                clearInterval(interval);
            }
        }, 15); // typing speed
    } else {
        moreContainer.style.display = 'none';
        toggleBtn.textContent = 'Learn More';
        typedTextEl.innerHTML = '';
    }
}
</script>
@endsection
