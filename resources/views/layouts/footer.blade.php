<!-- ========== FOOTER ========== -->
<footer class="bg-dark">
  <div class="container space-2">
    <div class="row justify-content-md-between">
      <div class="col-6 col-md-3 col-lg-2 order-lg-3 mb-7 mb-lg-0">
        <h3 class="h6 text-white mb-3">Contacts</h3>

        <!-- List Group -->
        <div class="list-group list-group-flush list-group-transparent">
          <a class="list-group-item list-group-item-action" href="about-agency.html"><i class="bi bi-geo-alt-fill"></i> Côte d'ivoire,<br>Abidjan-Koumassi</a>
          <a class="list-group-item list-group-item-action" href="about-start-up.html"><i class="bi bi-telephone-fill"></i> 225 01 02 20 52 11</a>
          <a class="list-group-item list-group-item-action" href="services-agency.html"><i class="bi bi-envelope-fill"></i> infos@citl.com</a>
        </div>
        <!-- End List Group -->
      </div>

      <div class="col-6 col-md-3 col-lg-2 order-lg-4 mb-7 mb-lg-0">
        <h3 class="h6 text-white mb-3">Nos Services</h3>

        <!-- List Group -->
        <div class="list-group list-group-flush list-group-transparent">
          <a class="list-group-item list-group-item-action" href="fret">Fret Maritime &amp; Aerien</a>
          <a class="list-group-item list-group-item-action" href="mantrans">Manutention &amp; Transit</a>
          <a class="list-group-item list-group-item-action" href="transport">Transport </a>
          <a class="list-group-item list-group-item-action" href="logistique">Logistique</a>
        </div>
        <!-- End List Group -->
      </div>

      <div class="col-6 col-md-3 col-lg-2 order-lg-5 mb-7 mb-lg-0">
        <h3 class="h6 text-white mb-3">A propos</h3>

        <!-- List Group -->
        <div class="list-group list-group-flush list-group-transparent">
          <a class="list-group-item list-group-item-action" href="about#Team">Notre Equipe</a>
          {{-- <a class="list-group-item list-group-item-action" href="#">Nos moyens</a> --}}
          <a class="list-group-item list-group-item-action" href="about#partenaires">Nos partenaires</a>
          {{-- <a class="list-group-item list-group-item-action" href="#">Nos projets</a> --}}
        </div>
        <!-- End List Group -->
      </div>

      <div class="col-6 col-md-3 col-lg-2 order-lg-6 mb-7 mb-lg-0">
        <h3 class="h6 text-white mb-3">Suivez-nous</h3>

        <!-- List -->
        <div class="list-group list-group-flush list-group-transparent">
          <a class="list-group-item list-group-item-action" href="#">
            <i class="bi bi-facebook"></i>
            Facebook
          </a>
          {{-- <a class="list-group-item list-group-item-action" href="#">
            <i class="fab fa-twitter min-width-3 text-center mr-2"></i>
            Twitter
          </a> --}}
        </div>
        <!-- End List -->
      </div>

      <div class="col-lg-4 order-lg-1 d-flex align-items-start flex-column">
        <!-- Logo -->
        <a class="d-inline-block mb-5" href="/" aria-label="Space">
          {{-- <img src="{{asset('assets/logo-short.jpg')}}" alt="Logo" style="width: 40px; max-width: 100%;"> --}}
          <h5 style="color:#00a0e1;">COMPAGNIE IVOIRIENNE DE TRANSPORT ET LOGISTIQUE</h5>
        </a>
        <!-- End Logo -->


        <p class="small text-muted">Tous droits reservés. &copy; 2021 - CITL</p>
      </div>
    </div>
  </div>
</footer>
<!-- ========== END FOOTER ========== -->

<!-- ========== END SECONDARY CONTENTS ========== -->
<!-- Signup Modal Window -->
<div id="signupModal" class="js-signup-modal u-modal-window" style="width: 500px;">
  <!-- Modal Close Button -->
  <button class="btn btn-sm btn-icon btn-text-secondary u-modal-window__close" type="button" onclick="Custombox.modal.close();">
    {{-- <i class="fas fa-times"></i> --}}
    <i class="bi bi-x-circle"></i>
  </button>
  <!-- End Modal Close Button -->

  <!-- Content -->
  <div class="p-5 bg-white rounded">
    <form class="js-validate">
      <!-- Signin -->
      <div id="signin" data-target-group="idForm">
        <!-- Title -->
        <header class="text-center mb-5">
          <h2 class="h4 mb-0">Suivie en temps réel</h2>
          <p>De vos commandes chez CITL</p>
        </header>
        <!-- End Title -->

        <!-- Input -->
        <div class="js-form-message mb-3">
          <div class="js-focus-state input-group form">
            <div class="input-group-prepend form__prepend">
              {{-- <span class="input-group-text form__text">
                <i class="fa fa-user form__text-inner"></i>
              </span> --}}
            </div>
            <input type="text" class="form-control form__input" name="conteneur" required
                   placeholder="Numéro du conteneur"
                   aria-label="Numéro du conteneur"
                   data-msg="Svp, entrez votre Numéro du conteneur"
                   data-error-class="u-has-error"
                   data-success-class="u-has-success">
          </div>
        </div>
        <!-- End Input -->

        <!-- Input -->
        <div class="js-form-message mb-3">
          <div class="js-focus-state input-group form">

            <input type="text" class="form-control form__input" name="conteneur" required
                   placeholder="Bon de livraison"
                   aria-label="Bon de livraison"
                   data-msg="Svp, entrez votre Bon de livraison"
                   data-error-class="u-has-error"
                   data-success-class="u-has-success">
          </div>
        </div>
        <!-- End Input -->

        <div class="row mb-3">
          {{-- <div class="col-6">
            <!-- Checkbox -->
            <div class="custom-control custom-checkbox d-flex align-items-center text-muted">
              <input type="checkbox" class="custom-control-input" id="rememberMeCheckbox">
              <label class="custom-control-label" for="rememberMeCheckbox">
                Remember Me
              </label>
            </div>
            <!-- End Checkbox -->
          </div> --}}

          {{-- <div class="col-6 text-right">
            <a class="js-animation-link float-right" href="javascript:;"
               data-target="#forgotPassword"
               data-link-group="idForm"
               data-animation-in="fadeIn">Forgot Password?</a>
          </div> --}}
        </div>

        <div class="mb-3">
          <button type="submit" class="btn btn-block btn-danger">Tracker</button>
        </div>

        {{-- <div class="text-center mb-3">
          <p class="text-muted">
            Do not have an account?
            <a class="js-animation-link" href="javascript:;"
               data-target="#signup"
               data-link-group="idForm"
               data-animation-in="fadeIn">Signup
            </a>
          </p>
        </div> --}}

        <!-- Divider -->
        {{-- <div class="text-center u-divider-wrapper my-3">
          <span class="u-divider u-divider--xs u-divider--text">OR</span>
        </div> --}}
        <!-- End Divider -->

        <!-- Signin Social Buttons -->
        {{-- <div class="row mx-gutters-2 mb-4">
          <div class="col-sm-6 mb-2 mb-sm-0">
            <button type="button" class="btn btn-block btn-facebook text-nowrap">
              <i class="fab fa-facebook-f mr-2"></i>
              Signin with Facebook
            </button>
          </div>
          <div class="col-sm-6">
            <button type="button" class="btn btn-block btn-twitter">
              <i class="fab fa-twitter mr-2"></i>
              Signin with Twitter
            </button>
          </div>
        </div> --}}
        <!-- End Signin Social Buttons -->
      </div>
      <!-- End Signin -->

      <!-- Signup -->
      <div id="signup" style="display: none; opacity: 0;" data-target-group="idForm">
        <!-- Title -->
        <header class="text-center mb-5">
          <h2 class="h4 mb-0">Please sign up</h2>
          <p>Fill out the form to get started.</p>
        </header>
        <!-- End Title -->

        <!-- Input -->
        <div class="js-form-message mb-3">
          <div class="js-focus-state input-group form">
            <div class="input-group-prepend form__prepend">
              <span class="input-group-text form__text">
                <i class="fa fa-user form__text-inner"></i>
              </span>
            </div>
            <input type="email" class="form-control form__input" name="email" required
                   placeholder="Email"
                   aria-label="Email"
                   data-msg="Please enter a valid email address."
                   data-error-class="u-has-error"
                   data-success-class="u-has-success">
          </div>
        </div>
        <!-- End Input -->

        <!-- Input -->
        <div class="js-form-message mb-3">
          <div class="js-focus-state input-group form">
            <div class="input-group-prepend form__prepend">
              <span class="input-group-text form__text">
                <i class="fa fa-lock form__text-inner"></i>
              </span>
            </div>
            <input type="password" class="form-control form__input" name="password" id="password" required
                   placeholder="Password"
                   aria-label="Password"
                   data-msg="Your password is invalid. Please try again."
                   data-error-class="u-has-error"
                   data-success-class="u-has-success">
          </div>
        </div>
        <!-- End Input -->

        <!-- Input -->
        <div class="js-form-message mb-3">
          <div class="js-focus-state input-group form">
            <div class="input-group-prepend form__prepend">
              <span class="input-group-text form__text">
                <i class="fa fa-key form__text-inner"></i>
              </span>
            </div>
            <input type="password" class="form-control form__input" name="confirmPassword" required
                   placeholder="Confirm Password"
                   aria-label="Confirm Password"
                   data-msg="Password does not match the confirm password."
                   data-error-class="u-has-error"
                   data-success-class="u-has-success">
          </div>
        </div>
        <!-- End Input -->

        <div class="mb-3">
          <button type="submit" class="btn btn-block btn-primary">Signup</button>
        </div>

        <div class="text-center mb-3">
          <p class="text-muted">
            Have an account?
            <a class="js-animation-link" href="javascript:;"
               data-target="#signin"
               data-link-group="idForm"
               data-animation-in="fadeIn">Signin
            </a>
          </p>
        </div>

        <!-- Divider -->
        <div class="text-center u-divider-wrapper my-3">
          <span class="u-divider u-divider--xs u-divider--text">OR</span>
        </div>
        <!-- End Divider -->

        <!-- Signup Social Buttons -->
        <div class="row mx-gutters-2 mb-4">
          <div class="col-sm-6 mb-2 mb-sm-0">
            <button type="button" class="btn btn-block btn-facebook text-nowrap">
              <i class="fab fa-facebook-f mr-2"></i>
              Signup with Facebook
            </button>
          </div>
          <div class="col-sm-6">
            <button type="button" class="btn btn-block btn-twitter">
              <i class="fab fa-twitter mr-2"></i>
              Signup with Twitter
            </button>
          </div>
        </div>
        <!-- End Signup Social Buttons -->
      </div>
      <!-- End Signup -->

      <!-- Forgot Password -->
      <div id="forgotPassword" style="display: none; opacity: 0;" data-target-group="idForm">
        <!-- Title -->
        <header class="text-center mb-5">
          <h2 class="h4 mb-0">Recover account</h2>
          <p>Enter your email address and an email with instructions will be sent to you.</p>
        </header>
        <!-- End Title -->

        <!-- Input -->
        <div class="js-form-message mb-3">
          <div class="js-focus-state input-group form">
            <div class="input-group-prepend form__prepend">
              <span class="input-group-text form__text">
                <i class="fa fa-user form__text-inner"></i>
              </span>
            </div>
            <input type="email" class="form-control form__input" name="email" required
                   placeholder="Email"
                   aria-label="Email"
                   data-msg="Please enter a valid email address."
                   data-error-class="u-has-error"
                   data-success-class="u-has-success">
          </div>
        </div>
        <!-- End Input -->

        <div class="mb-3">
          <button type="submit" class="btn btn-block btn-primary">Recover Account</button>
        </div>

        <div class="text-center mb-3">
          <p class="text-muted">
            Have an account?
            <a class="js-animation-link" href="javascript:;"
               data-target="#signin"
               data-link-group="idForm"
               data-animation-in="fadeIn">Signin
            </a>
          </p>
        </div>
      </div>
      <!-- End Forgot Password -->
    </form>
  </div>
  <!-- End Content -->
</div>
<!-- End Signup Modal Window -->
  {{-- <!-- Go to Top -->
  <a class="js-go-to u-go-to" href="javascript:;"
    data-position='{"bottom": 15, "right": 15 }'
    data-type="fixed"
    data-offset-top="400"
    data-compensation="#header"
    data-show-effect="slideInUp"
    data-hide-effect="slideOutDown">
    <i class="fa fa-arrow-up u-go-to__inner"></i>
  </a>
  <!-- End Go to Top --> --}}

  <!-- JS Global Compulsory -->
  <script src="{{asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('assets/vendor/jquery-migrate/dist/jquery-migrate.min.js')}}"></script>
  <script src="{{asset('assets/vendor/popper.js/dist/umd/popper.min.js')}}"></script>
  <script src="{{asset('assets/vendor/bootstrap/bootstrap.min.js')}}"></script>

  <!-- JS Implementing Plugins -->
  <script src="{{asset('assets/vendor/hs-megamenu/src/hs.megamenu.js')}}"></script>
  <script src="{{asset('assets/vendor/jquery-validation/dist/jquery.validate.min.js')}}"></script>
  <script src="{{asset('assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')}}"></script>
  <script src="{{asset('assets/vendor/custombox/dist/custombox.min.js')}}"></script>
  <script src="{{asset('assets/vendor/custombox/dist/custombox.legacy.min.js')}}"></script>
  <script src="{{asset('assets/vendor/slick-carousel/slick/slick.js')}}"></script>
  <script src="{{asset('assets/vendor/dzsparallaxer/dzsparallaxer.js')}}"></script>
  <script src="{{asset('assets/vendor/cubeportfolio/js/jquery.cubeportfolio.min.js')}}"></script>
  <script src="{{asset('assets/vendor/player.js/dist/player.min.js')}}"></script>

  <!-- JS Space -->
  <script src="{{asset('assets/js/hs.core.js')}}"></script>
  <script src="{{asset('assets/js/components/hs.header.js')}}"></script>
  <script src="{{asset('assets/js/components/hs.unfold.js')}}"></script>
  <script src="{{asset('assets/js/components/hs.validation.js')}}"></script>
  <script src="{{asset('assets/js/helpers/hs.focus-state.js')}}"></script>
  <script src="{{asset('assets/js/components/hs.malihu-scrollbar.js')}}"></script>
  <script src="{{asset('assets/js/components/hs.modal-window.js')}}"></script>
  <script src="{{asset('assets/js/components/hs.show-animation.js')}}"></script>
  <script src="{{asset('assets/js/components/hs.slick-carousel.js')}}"></script>
  <script src="{{asset('assets/js/components/hs.cubeportfolio.js')}}"></script>
  <script src="{{asset('assets/js/components/hs.video-player.js')}}"></script>
  <script src="{{asset('assets/js/components/hs.go-to.js')}}"></script>

  <!-- JS Plugins Init. -->
  <script>
    $(window).on('load', function () {
      // initialization of HSMegaMenu component
      $('.js-mega-menu').HSMegaMenu({
        event: 'hover',
        pageContainer: $('.container'),
        breakpoint: 991,
        hideTimeOut: 0
      });
    });

    $(document).on('ready', function () {
      // initialization of header
      $.HSCore.components.HSHeader.init($('#header'));

      // initialization of unfold component
      $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
        afterOpen: function () {
          if (!$('body').hasClass('IE11')) {
            $(this).find('input[type="search"]').focus();
          }
        }
      });

      // initialization of form validation
      $.HSCore.components.HSValidation.init('.js-validate', {
        rules: {
          confirmPassword: {
            equalTo: '#password'
          }
        }
      });

      // initialization of forms
      $.HSCore.helpers.HSFocusState.init();

      // initialization of malihu scrollbar
      $.HSCore.components.HSMalihuScrollBar.init($('.js-scrollbar'));

      // initialization of autonomous popups
      $.HSCore.components.HSModalWindow.init('[data-modal-target]', '.js-signup-modal', {
        autonomous: true
      });

      // initialization of show animations
      $.HSCore.components.HSShowAnimation.init('.js-animation-link');

      // initialization of slick carousel
      $.HSCore.components.HSSlickCarousel.init('.js-slick-carousel');

      // initialization of cubeportfolio
      $.HSCore.components.HSCubeportfolio.init('.cbp');

      // initialization of video player
      $.HSCore.components.HSVideoPlayer.init('.js-inline-video-player');

      // initialization of go to
      $.HSCore.components.HSGoTo.init('.js-go-to');
    });
  </script>
</body>

</html>
