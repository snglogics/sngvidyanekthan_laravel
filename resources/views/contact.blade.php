@extends('layouts.layout')
@section('content')
    <section id="contact-page" class="pt-90 pb-120 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div id="formMessage"></div>

                    <div class="contact-from mt-30">
                        <div class="section-title">
                            <h5>Contact Us</h5>
                            <h2>Keep in touch</h2>
                        </div>

                        <div class="main-form pt-45">
                            <form id="contact-form" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="singel-form form-group">
                                            <input name="name" type="text" placeholder="Your name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="singel-form form-group">
                                           <input 
    type="email" 
    name="email" 
    class="form-control" 
    required 
    pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
    title="Please enter a valid email (e.g., user@example.com)"
>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="singel-form form-group">
                                            <input name="subject" type="text" placeholder="Subject" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="singel-form form-group">
                                            <input name="phone" type="text" placeholder="Phone" required pattern="\d{10}" title="Enter a 10-digit mobile number">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="singel-form form-group">
                                            <textarea name="messege" placeholder="Message" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="singel-form">
                                            <button type="submit" class="main-btn" id="submitBtn">Send</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!--  contact from -->

                <div class="col-lg-5">
                    <div class="contact-address mt-30">
                        <ul>
                            <li>
                                <div class="singel-address">
                                    <div class="icon">
                                        <i class="fa fa-home"></i>
                                    </div>
                                    <div class="cont">
                                        <p>Valmiki Hills, Thottumughom, Aluva. (Managed by Sree Narayana Dharma Sanghom
                                            Trust)</p>
                                    </div>
                                </div> <!-- singel address -->
                            </li>
                            <li>
                                <div class="singel-address">
                                    <div class="icon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="cont">
                                        <p>+91 7994573586</p>
                                        <p>+0484-2632102, 2626490</p>
                                    </div>
                                </div> <!-- singel address -->
                            </li>
                            <li>
                                <div class="singel-address">
                                    <div class="icon">
                                        <i class="fa fa-envelope-o"></i>
                                    </div>
                                    <div class="cont">
                                        <p>svidyaaluva@yahoo.com</p>
                                        <p>aluvasvidya@gmail.com</p>
                                    </div>
                                </div> <!-- singel address -->
                            </li>
                        </ul>
                    </div> <!-- contact address -->
                    <div class="map mt-30">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d251382.73388440683!2d76.380997!3d10.110935000000001!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x162afe6ad79d5654!2sSivagiri%20Vidyaniketan!5e0!3m2!1sen!2sin!4v1658994074003!5m2!1sen!2sin"
                            width="100%" height="100%" style="border: 0; border-radius: 10px;" allowfullscreen=""
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Google Map Embed"></iframe>
                    </div> <!-- map -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contact-form');
    const submitBtn = document.getElementById('submitBtn');
    const formMessage = document.getElementById('formMessage');

    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        submitBtn.disabled = true;
        submitBtn.innerText = 'Sending...';
        formMessage.innerHTML = '';

        const formData = new FormData(form);
        try {
            const response = await fetch("{{ route('contact.submit') }}", {
                method: "POST",
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: formData
            });

            // Check if response is JSON
            const contentType = response.headers.get('content-type');
            if (contentType && contentType.includes('application/json')) {
                const data = await response.json();
                
                if (response.ok && data.success) {
                    formMessage.innerHTML = 
                        `<div class="alert alert-success">${data.message}</div>`;
                    form.reset();
                } else {
                    let errorText = data.message || 'Submission failed.';
                    if (data.errors) {
                        errorText += '<ul>';
                        for (let key in data.errors) {
                            errorText += `<li>${data.errors[key][0]}</li>`;
                        }
                        errorText += '</ul>';
                    }
                    formMessage.innerHTML = 
                        `<div class="alert alert-danger">${errorText}</div>`;
                }
            } else {
                // Handle non-JSON response
                const text = await response.text();
                formMessage.innerHTML = 
                    `<div class="alert alert-danger">Unexpected response from server: ${text}</div>`;
            }
        } catch (error) {
            // Network errors or other exceptions
            console.error('Error:', error);
            formMessage.innerHTML = 
                `<div class="alert alert-danger">Network error occurred. Please try again.</div>`;
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerText = 'Send';
        }
    });
});
    </script>
@endsection
