
<?php $__env->startSection('content'); ?>
<!-- 
    --------------------------------
    -------- / contact / -----------
    --------------------------------
     -->
     <div class="container py-5">
        <div class="row gy-5">
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="title-wrapper">
                    <h4>SEND US AN EMAIL</h4>
                    <span class="right-line"></span>
                </div>
                <form action="/" method="post" class="contact-form">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>First Name</label>
                            <input type="text" name="first-name" placeholder="First Name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Last Name</label>
                            <input type="text" name="last-name" placeholder="Last Name" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Your Email</label>
                            <input type="email" name="your-email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Phone Number</label>
                            <input type="tel" name="tel-767" placeholder="Phone number">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Your Message</label>
                        <textarea name="your-message" rows="4" placeholder="Enter your message" required></textarea>
                    </div>
                    <button type="submit" class="form-btn">ASK A QUESTION</button>
                </form>
            </div>

            <!-- Contact Us Section -->
            <div class="col-lg-6 col-md-12">
                <div class="title-wrapper">
                    <h4>contact us</h4>
                    <span class="right-line"></span>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="info-box-wrapper">
                            <p><strong>Phone:</strong> <a href="tel:03099026655">03099026655</a></p>
                            <p><strong>Phone:</strong> <a href="tel:03177179873">03177179873</a></p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="info-box-wrapper">
                            <p><strong>Address:</strong> Bahria Town Karachi, Midway Commercial B103 3rd Floor Ghazi
                                Apparel 1984</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="info-box-wrapper">
                            <p><strong>Free shipping for all orders above Rs. 5000 in Pakistan.</strong></p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="info-box-wrapper">
                            <p><strong>Opening Hours:</strong></p>
                            <p>Mon-Fri: 8:00-19:00<br>
                                Sat: 8:00-14:00<br>
                                Sun: closed</p>
                        </div>
                    </div>
                </div>
                <div class="separator"></div>
                <div class="text_column">
                    <p>Do you have questions about how we can help your company?<br>
                        <a href="mailto:info@ghazi1984thebrand.com">Send us an email and
                            we'll get in touch shortly.</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ghazi1984/public_html/resources/views/frontend/contactUs.blade.php ENDPATH**/ ?>