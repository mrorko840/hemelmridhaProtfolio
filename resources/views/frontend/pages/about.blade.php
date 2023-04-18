<!-- ======= About Section ======= -->
<section id="about" class="about">
    <div class="container">

        <div class="section-title">
            <h2>About</h2>
        </div>

        <div class="row">
            <div class="col-lg-4" data-aos="fade-right">
                <img src="{{ asset('assets/img/profile/'.$about->image) }}" class="img-fluid" alt="">
            </div>
            <div class="col-lg-8 pt-4 pt-lg-0 content" data-aos="fade-left">
                <h3>{{@$about->title}}</h3>
                <div class="row">
                    <div class="col-lg-6">
                        <ul>
                            <li><i class="bi bi-chevron-right"></i> <strong>Birthday:</strong> <span>{{date_format(date_create($about->dob), 'd M Y')}}</span></li>
                            <li><i class="bi bi-chevron-right"></i> <strong>Website:</strong>
                                <span>{{ $about->website }}</span>
                            </li>
                            <li><i class="bi bi-chevron-right"></i> <strong>Phone:</strong> <span>{{ $about->phone }}</span></li>
                            <li><i class="bi bi-chevron-right"></i> <strong>City:</strong> <span>{{ $about->address }}</span></li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <ul>
                            <li><i class="bi bi-chevron-right"></i> <strong>Age:</strong> <span>{{(date('Y'))-(date_format(date_create($about->dob), 'Y'))}}</span></li>
                            <li><i class="bi bi-chevron-right"></i> <strong>Degree:</strong>
                                <span>{{ $about->education }}</span>
                            </li>
                            <li><i class="bi bi-chevron-right"></i> <strong>Email:</strong>
                                <span>{{ $about->email }}</span>
                            </li>
                            <li><i class="bi bi-chevron-right"></i> 
                                <strong>Freelance:</strong>
                                <span>Available</span>
                            </li>
                        </ul>
                    </div>
                    <p>
                        @php
                            echo $about->details
                        @endphp
                    </p>
                </div>
            </div>
        </div>

    </div>
</section><!-- End About Section -->
