
<?php $__env->startSection('content'); ?>
<!-- 
    --------------------------------
    ------- / about section / ------
    --------------------------------
     -->
     <div class="full-screen-bg">
        <div class="about-us-text">
            <h4>ABOUT US</h4>
            <p>Ghazi apparel is the b2c supplier of sportswear to empower youth through our quality products as we
                believe in the power of great services to our customers. We offer an elegant range of team wear in a
                combination of designs and colors incorporating casual and fashion wears. Ghazi wants their consumers to
                view the world more motivated, independent, and passionate individuals through our little efforts in
                this regard incorporating the small or large orders throughout Pakistan. We go to the great lengths to
                fascinate our elite benefits to our buyers among the vigorous team who assures to get you our full
                attention and care throughout fast and hassle free services. Offering the best prices regardless of the
                size of the orders. In addition, utilizing the latest and fastest delivery sources. Ghazi apparel
                services provided to help spark your performance imagination closer to reality. Discover a truly
                unforgettable experience with us!</p>
        </div>
    </div>

    <!-- 
    --------------------------------
    --- / mission section / --------
    --------------------------------
     -->
    <div class="section-mission container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-6 mission-image-container">
                <img src="<?php echo e(asset('assets/images/mission-image.webp')); ?>" alt="Mission" class="mission-image">
            </div>
            <div class="col-lg-6 mission-text">
                <h3>MISSION STATEMENT</h3>
                <p>We want the youth never stop turning their zeal on peak limiting their worries in the practicing or
                    final performances. Ensure the fault-free and time effective services surrounding extra miles in
                    quality.</p>
            </div>
        </div>
    </div>

    <!-- 
    --------------------------------
    ---- / vision section / --------
    --------------------------------
     -->
    <div class="section-vision container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-6 order-lg-2 vision-image-container">
                <img src="<?php echo e(asset('assets/images/vision-image.webp')); ?>" alt="Vision" class="vision-image">
            </div>
            <div class="col-lg-6 order-lg-1 vision-text">
                <h3>VISION STATEMENT</h3>
                <p>To maximize the geographical area in serving our assistance nationwide. To strategically work with
                    latest technologies to handle our management tasks helping out facing fewer errors.</p>
            </div>
        </div>
    </div>

    <!-- 
    --------------------------------
    -------- / team section / ------
    --------------------------------
     -->
    <div class="section-team container">
        <div class="section-title-content">
            <div class="section-title">
                <h4 class="heading-title">our team</h4>
            </div>
        </div>
        <div class="row gy-5 team-container">
            <div class="col-md-3">
                <div class="team-member">
                    <div class="team-member-image">
                        <img src="<?php echo e(asset('assets/images/team-member-1.webp')); ?>" alt="Team Member">
                    </div>
                    <div class="team-member-info">
                        <h5>Naveed Raza</h5>
                        <p>Chief Executive Officer</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="team-member">
                    <div class="team-member-image">
                        <img src="<?php echo e(asset('assets/images/team-member-2.webp')); ?>" alt="Team Member">
                    </div>
                    <div class="team-member-info">
                        <h5>Haider Ali</h5>
                        <p>CHEIF FINANCIAL OFFICER</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="team-member">
                    <div class="team-member-image">
                        <img src="<?php echo e(asset('assets/images/team-member-3.webp')); ?>" alt="Team Member">
                    </div>
                    <div class="team-member-info">
                        <h5>Fakhar-E-Ahtesham</h5>
                        <p>Chief Operation Officer</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ghazi1984/public_html/resources/views/frontend/aboutUs.blade.php ENDPATH**/ ?>