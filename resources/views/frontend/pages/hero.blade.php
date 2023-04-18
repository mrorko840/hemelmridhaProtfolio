<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex flex-column justify-content-center align-items-center">
    <div class="hero-container" data-aos="fade-in">
        <h1>{{$about->name}}</h1>
        <p>I'm <span class="typed" data-typed-items="
                @foreach (json_decode($home_section->profession) as $profession)
                    {{$profession.','}}
                @endforeach
            "></span>
        </p>
    </div>
</section><!-- End Hero -->