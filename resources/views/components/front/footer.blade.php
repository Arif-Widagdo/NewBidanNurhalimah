  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="footer-newsletter">
      {{-- <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-12 text-center">
            <h4>Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
          </div>
          <div class="col-lg-6">
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>
        </div>
      </div> --}}
    </div>

    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-5 col-md-12 footer-info">
            <a href="index.html" class="logo d-flex align-items-center">
              <img src="{{ asset('dist/img/logos/logo.png') }}" alt="">
              <span>Bidan Nurhalimah</span>
            </a>
            <p>{{ __('Two Better Children, Lets Join the Family Planning Program to Become a Better Family.') }}</p>
            <div class="social-links mt-3">
              @if($site->twitter != '')
              <a href="{{ $site->twitter }}" class="twitter" target="_blank"><i class="bi bi-twitter"></i></a>
              @endif

              @if($site->facebook != '')
              <a href="{{ $site->facebook }}" class="facebook" target="_blank"><i class="bi bi-facebook"></i></a>
              @endif

              @if($site->instagram != '')
              <a href="{{ $site->instagram }}" class="instagram" target="_blank"><i class="bi bi-instagram"></i></a>
              @endif
              
              @if($site->linkedin != '')
              <a href="{{ $site->linkedin }}" class="linkedin" target="_blank"><i class="bi bi-linkedin"></i></a>
              @endif
            </div>
          </div>

          <div class="col-lg-2 col-6 footer-links">
            <h4>{{ __('Useful Links') }}</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="/#hero">{{ __('Home') }}</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#features">{{ __('About Us') }}</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#services">{{ __('Services') }}</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#faq">F.A.Q</a></li>
            </ul>
          </div>

          <div class="col-lg-2 col-6 footer-links">
            <h4>{{ __('Our Services') }}</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#services">{{ __('Apotek') }}</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#services">{{ __('Consultation') }}</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#services">{{ __('Childbirth') }}</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start p-0">
            <h4>{{ __('Contact Us') }}</h4>
            <p>
              {{ $site->address }}
              <br>
              <strong>{{ __('Number Phone') }} :</strong> {{ $site->telp }}<br>
              <strong>{{ __('Email') }} :</strong> {{ $site->email }}<br>
            </p>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; {{ __('Copyright') }} <strong><span>Bidan Nurhalimah</span></strong>. {{ __('All Rights Reserved') }}
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/flexstart-bootstrap-startup-template/ -->
        {{ __('Designed by') }} <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->
