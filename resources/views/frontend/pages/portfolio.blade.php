<!-- ======= Portfolio Section ======= -->
<section id="portfolio" class="portfolio section-bg">
    <div class="container">

        <div class="section-title">
            <h2>Portfolio</h2>
            <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit
                sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias
                ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="row" data-aos="fade-up">
            <div class="col-lg-12 d-flex justify-content-center">
                <ul id="portfolio-flters">
                    <li data-filter="*" class="filter-active">All</li>

                    @if ($portfolio['types']->count() > 1)
                        @foreach ($portfolio['types'] as $item)
                            <li data-filter=".filter-{{$item->type}}">{{$item->type}}</li>
                        @endforeach
                    @endif
                    
                </ul>
            </div>
        </div>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="100">

            @foreach ($portfolio['all'] as $item)
                <div class="col-lg-4 col-md-6 portfolio-item filter-{{$item->type}}">
                    <div class="portfolio-wrap" style="height: 252px;">
                        <img src="{{ asset('assets/img/portfolio/'. $item->image) }}" class="img-fluid" alt="">
                        <div class="portfolio-links">
                            <a href="{{ asset('assets/img/portfolio/'. $item->image) }}" 
                                data-gallery="portfolioGallery"
                                class="portfolio-lightbox" 
                                title="{{ $item->title }}">
                                <i class="bx bx-plus"></i>
                            </a>
                            <a target="_blank" href="{{ $item->link }}" title="More Details">
                                <i class="bx bx-link"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

    </div>
</section><!-- End Portfolio Section -->
