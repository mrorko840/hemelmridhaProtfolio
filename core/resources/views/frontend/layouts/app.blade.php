@include('frontend.includes.head')

<body>
    
    @include('frontend.includes.header')
    
    
    @include('frontend.pages.hero')
    
    
    <main id="main">
        
        @include('frontend.pages.about')
        
        {{-- @include('frontend.pages.facts') --}}
        
        @include('frontend.pages.skills')
        
        {{-- @include('frontend.pages.resume') --}}
        
        @include('frontend.pages.portfolio')
        
        {{-- @include('frontend.pages.services') --}}
        
        {{-- @include('frontend.pages.testimonials') --}}
        
        @include('frontend.pages.contact')

    </main><!-- End #main -->

        @include('frontend.includes.footer')
        
        @include('frontend.includes.script')
</body>

</html>
