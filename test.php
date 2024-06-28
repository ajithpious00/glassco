<style>
.white-icon {
    color: #ffffff; /* White color */
}

</style>
  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

<div class="container footer-top">
    <div class="row gy-4">
        <div class="col-lg-4 col-md-12 footer-about">
            <a href="<?php echo base_url(); ?>" class="logo d-flex align-items-center">
                <img class="logo1" src="<?php echo base_url('public/website/inner/'); ?>assets/img/Cleonett_vents_Logo_whihte.png" alt="">
            </a>
            <p style="padding-right: 20px;">We have a long history of providing outstanding service and high-end production, dating back over 25 years.</p>
            <div class="social-links d-flex mt-4">
                <a href="https://www.youtube.com/@cleonettevents/"><i class="bi bi-youtube white-icon"></i></a>
                <a href="https://www.facebook.com/CleonettEventsandEntertainmentLLP/"><i class="bi bi-facebook white-icon"></i></a>
                <a href="https://www.instagram.com/cleonettevents/"><i class="bi bi-instagram white-icon"></i></a>
                <a href="https://www.linkedin.com/company/cleonett-events-and-entertainment-llp/mycompany/"><i class="bi bi-linkedin white-icon"></i></a>
            </div>
        </div>

        <div class="col-lg-2 col-6 footer-links" style="padding-left: 21px;">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="<?php echo base_url('events'); ?>">Event Management</a></li>
                <li><a href="<?php echo base_url('digitals'); ?>">Digital Marketing</a></li>
                <li><a href="<?php echo base_url('wedding'); ?>">Wedding Stylist</a></li>
                <li><a href="#">Terms of service</a></li>
                <li><a href="#">Privacy policy</a></li>
            </ul>
        </div>

        <div class="col-lg-3 col-md-6 footer-contact" style="padding-left: 77px; padding-right: 20px;">
            <h4>Kochi</h4>
            <p>PNRWA-71, Panampilly Nagar,</p>
            <p>Kochi, Ernakulam 682036</p>
            <p>Kerala, India</p>
            <p class="mt-4"><strong>Phone:</strong> <span>+91 98470 43434</span></p>
            <p><strong>Email:</strong> <span>info@cleonett.com</span></p>
        </div>

        <div class="col-lg-3 col-md-6 footer-contact" style="padding-left: 76px; padding-right: 20px;">
            <h4>Mumbai</h4>
            <p>#4, Orbit Premises,</p>
            <p>Opp. Grand Hometel Hotel,</p>
            <p>Off Link Road, Mindspace,</p>
            <p>Malad (W), Mumbai - 400064</p>
            <p>Maharashtra, India</p>
            <p class="mt-4"><strong>Phone:</strong> <span>+91 75067 11440</span></p>
            <p><strong>Email:</strong> <span>info@cleonett.com</span></p>
        </div>
    </div>
</div>



    <div class="container copyright text-center mt-4">
      <p>&copy; <span>Copyright 2023</span><strong class="px-1"> Cleonett.</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        Designed by <a href="https://www.v4csolutions.com/" target="_blank" style="color: #ffffff;">V4C Solutions Pvt Ltd.</a>

      </div>
    </div>

  </footer><!-- End Footer -->

  <!-- Scroll Top Button -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
  </div>

	<!-- Vendor JS Files -->
	<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
	<script src="<?php echo base_url('public/website/inner/'); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?php echo base_url('public/website/inner/'); ?>assets/vendor/glightbox/js/glightbox.min.js"></script>
	<script src="<?php echo base_url('public/website/inner/'); ?>assets/vendor/purecounter/purecounter_vanilla.js"></script>
	<script src="<?php echo base_url('public/website/inner/'); ?>assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
	<script src="<?php echo base_url('public/website/inner/'); ?>assets/vendor/swiper/swiper-bundle.min.js"></script>
	<script src="<?php echo base_url('public/website/inner/'); ?>assets/vendor/aos/aos.js"></script>
	<script src="<?php echo base_url('public/website/inner/'); ?>assets/vendor/php-email-form/validate.js"></script>

	<!-- Template Main JS File -->
	<script src="<?php echo base_url('public/website/inner/'); ?>assets/js/main.js"></script>
	<script>
	$(document).ready(function(){
		var pageUrl = '<?php echo $page ?>';
		var base_url = '<?php echo base_url('public/website/inner/assets/img/'); ?>';
		window.scrollTo(0,0);
		if(pageUrl=='home') {
			var scroll = $(window).scrollTop();
			if(scroll > 130) {
				$('.logo').attr('src', base_url + 'logo.png');
			}
			else {
				$('.logo').attr('src', base_url + 'logo-wt.png');
			}
			$(window).scroll(function (event) {
				scroll = $(window).scrollTop();
				if(scroll > 130) {
					$('.logo').attr('src', base_url + 'logo.png');
				}
				else {
					$('.logo').attr('src', base_url + 'logo-wt.png');
					$('.navmenu a').css('color','#000 !important');
				}
			});
		}
		else {
			$('.logo').attr('src', base_url + 'logo.png');
		}
	});	
	</script>
</body>

</html>