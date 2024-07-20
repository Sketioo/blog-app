@extends('layouts.app')

@section('title', 'Contact')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <h2>Contact Us</h2>
                <p>Feel free to reach out to us using the information below or by filling out the contact form.</p>
                <ul class="list-group">
                    <li class="list-group-item">
                        <i class="fas fa-phone-alt mr-2"></i> +6281 989 655 783
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-envelope mr-2"></i> martio@gethub.com
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-map-marker-alt mr-2"></i> 123 Banyuwangi Street, Jawa Timur, CA 48464
                    </li>
                </ul>
            </div>

            <div class="col-md-6">
                <h2>Get in Touch</h2>
                <form action="{{ route('contact.email') }}" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Name"
                            >
                    </div>
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="youremail@example.com" >
                    </div>
                    <div class="form-group mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="messageContent" rows="5" placeholder="Write your message here"
                            ></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </div>
@endsection
