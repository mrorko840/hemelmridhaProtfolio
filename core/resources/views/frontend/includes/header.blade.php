<!-- ======= Mobile nav toggle button ======= -->
<i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

<!-- ======= Header ======= -->
<header id="header">
    <div class="d-flex flex-column">

        <div class="profile">
            <img src="{{ asset('assets/img/profile/' . $about->image) }}" alt="" class="img-fluid rounded-circle">
            <h1 class="text-light"><a href="index.html">{{ $about->name }}</a></h1>
            <div class="social-links mt-3 text-center">
                @foreach ($social as $item)
                    <a href="{{ $item->link }}" target="_blanck" class="{{ strtolower($item->name) }}"><i
                            class="{{ $item->icon }}"></i></a>
                @endforeach
            </div>
        </div>

        <nav id="navbar" class="nav-menu navbar">
            <ul>
                <li>
                    <a href="#hero" class="nav-link scrollto active"><i class="bx bx-home"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li><a href="#about" class="nav-link scrollto"><i class="bx bx-user"></i> 
                        <span>About</span>
                    </a>
                </li>
                <li><a href="#skills" class="nav-link scrollto"><i class="bx bx-chart"></i>
                        <span>Skills</span>
                    </a>
                </li>
                {{-- <li><a href="#resume" class="nav-link scrollto"><i class="bx bx-file-blank"></i>
                        <span>Resume</span>
                    </a>
                </li> --}}
                <li><a href="#portfolio" class="nav-link scrollto"><i class="bx bx-book-content"></i>
                        <span>Portfolio</span>
                    </a>
                </li>
                {{-- <li><a href="#services" class="nav-link scrollto"><i class="bx bx-server"></i>
                        <span>Services</span>
                    </a>
                </li> --}}
                <li><a href="#contact" class="nav-link scrollto"><i class="bx bx-envelope"></i>
                        <span>Contact</span>
                    </a>
                </li>
            </ul>
        </nav><!-- .nav-menu -->
    </div>
</header><!-- End Header -->
