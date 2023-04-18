<!-- ======= Skills Section ======= -->
<section id="skills" class="skills section-bg">
    <div class="container">

        <div class="section-title">
            <h2>Skills</h2>
            <p>Skill is the ability to perform a task or activity effectively, 
                which has been acquired through practice, training, or experience. 
                It involves the mastery of a particular set of knowledge, techniques, 
                or abilities that enable someone to perform a specific task or function.
            </p>
        </div>

        <div class="row skills-content">
            @foreach ($skill as $item)
                <div class="col-lg-6" data-aos="fade-up">
                    <div class="progress">
                        <span class="skill">{{$item->name}} <i class="val">{{$item->percentage}}%</i></span>
                        <div class="progress-bar-wrap">
                            <div class="progress-bar" role="progressbar" aria-valuenow="{{$item->percentage}}" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>

    </div>
</section><!-- End Skills Section -->
