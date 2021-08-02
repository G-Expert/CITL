<!-- ========== HEADER ========== -->
<header id="header" class="u-header u-header--modern u-header--bordered u-header--sticky-top-lg">
  <div class="u-header__section">
    <div id="logoAndNav" class="container-fluid">
      <!-- Nav -->
      <nav class="js-mega-menu navbar navbar-expand-lg u-header__navbar">
        <!-- Logo -->
        <div class="u-header__navbar-brand-wrapper">
          <a class="navbar-brand u-header__navbar-brand" href="/" aria-label="Space">
            <img class="u-header__navbar-brand-default" src="{{asset('assets/lgf.jpg')}}" alt="Logo">
            <img class="u-header__navbar-brand-mobile" src="{{asset('assets/logo-short.jpg')}}" alt="Logo">
          </a>
        </div>
        <!-- End Logo -->

        <!-- Responsive Toggle Button -->
        <button type="button" class="navbar-toggler btn u-hamburger u-header__hamburger"
                aria-label="Toggle navigation"
                aria-expanded="false"
                aria-controls="navBar"
                data-toggle="collapse"
                data-target="#navBar">
          <span class="d-none d-sm-inline-block">Menu</span>
          <span id="hamburgerTrigger" class="u-hamburger__box ml-3">
            <span class="u-hamburger__inner"></span>
          </span>
        </button>
        <!-- End Responsive Toggle Button -->

        <!-- Navigation -->
        <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse py-0">
          <ul class="navbar-nav u-header__navbar-nav">
            <!-- Home -->

            <li class="nav-item hs-has-sub-menu u-header__nav-item"
                data-event="hover"
                data-animation-in="fadeInUp"
                data-animation-out="fadeOut">
              <a id="homeMegaMenu" class="nav-link u-header__nav-link" href="/"
                 aria-haspopup="true"
                 aria-expanded="false"
                 aria-labelledby="homeSubMenu">
                Acceuil
                {{-- <i class="fa fa-angle-down u-header__nav-link-icon"></i> --}}
              </a>

            </li>

            <!-- Works -->
            <li class="nav-item hs-has-sub-menu u-header__nav-item"
                data-event="hover"
                data-animation-in="fadeInUp"
                data-animation-out="fadeOut">
              <a id="worksMegaMenu" class="nav-link u-header__nav-link" href="javascript:;"
                 aria-haspopup="true"
                 aria-expanded="false"
                 aria-labelledby="worksSubMenu">
                Nos services
                {{-- <i class="fa fa-angle-down u-header__nav-link-icon"></i> --}}
              </a>

              <!-- Works - Submenu -->
              <ul id="worksSubMenu" class="list-inline hs-sub-menu u-header__sub-menu mb-0" style="min-width: 220px;"
                  aria-labelledby="worksMegaMenu">
                <!-- Classic -->
                <li class="dropdown-item hs-has-sub-menu">
                  <a id="navLinkWorksBoxedLayout" class="nav-link u-header__sub-menu-nav-link fret"
                     href="fret"
                     aria-haspopup="true"
                     aria-expanded="false"
                     aria-controls="navSubmenuWorksBoxedLayout">
                     Fret Maritime & aérien
                    {{-- <i class="fa fa-angle-right u-header__sub-menu-nav-link-icon"></i> --}}
                  </a>


                </li>
                <!-- Classic -->

                <li class="dropdown-item hs-has-sub-menu">
                  <a id="navLinkWorksSinglePage" class="nav-link u-header__sub-menu-nav-link manut"
                     href="mantrans"
                     aria-haspopup="true"
                     aria-expanded="false"
                     aria-controls="navSubmenuWorksSinglePage">
                     Manutention & Transit
                  </a>
                </li>

                <!-- Full Width -->
                <li class="dropdown-item hs-has-sub-menu">
                  <a id="navLinkWorksFullWidthLayout" class="nav-link u-header__sub-menu-nav-link transport"
                     href="transport"
                     aria-haspopup="true"
                     aria-expanded="false"
                     aria-controls="navSubmenuWorksFullWidthLayout">
                     Transport
                    {{-- <i class="fa fa-angle-right u-header__sub-menu-nav-link-icon"></i> --}}
                  </a>
                </li>
                <!-- Full Width -->

                <!-- Single Page -->
                <li class="dropdown-item hs-has-sub-menu">
                  <a id="navLinkWorksSinglePage" class="nav-link u-header__sub-menu-nav-link logis"
                     href="logistique"
                     aria-haspopup="true"
                     aria-expanded="false"
                     aria-controls="navSubmenuWorksSinglePage">
                     Logistique
                    {{-- <i class="fa fa-angle-right u-header__sub-menu-nav-link-icon"></i> --}}
                  </a>

                </li>
                <!-- Single Page -->



              </ul>
              <!-- End Works - Submenu -->
            </li>
            <!-- End Works -->

            <!-- Blog -->
            <li class="nav-item hs-has-sub-menu u-header__nav-item"
                data-event="hover"
                data-animation-in="fadeInUp"
                data-animation-out="fadeOut">
              <a id="blogMegaMenu" class="nav-link u-header__nav-link" href="javascript:;"
                 aria-haspopup="true"
                 aria-expanded="false"
                 aria-labelledby="blogSubMenu">
                A propos
                {{-- <i class="fa fa-angle-down u-header__nav-link-icon"></i> --}}
              </a>

              <!-- Blog - Submenu -->
              <ul id="blogSubMenu" class="list-inline hs-sub-menu u-header__sub-menu mb-0" style="min-width: 220px;"
                  aria-labelledby="blogMegaMenu">
                <!-- Classic -->
                <li class="dropdown-item hs-has-sub-menu">
                  <a id="navLinkBlogClassic" class="nav-link u-header__sub-menu-nav-link Team"
                     href="/about#Team"
                     aria-haspopup="true"
                     aria-expanded="false"
                     aria-controls="navSubmenuBlogClassic">
                     Notre Equipe
                    {{-- <i class="fa fa-angle-right u-header__sub-menu-nav-link-icon"></i> --}}
                  </a>

                </li>
                <!-- Classic -->



                <!-- List -->
                {{-- <li class="dropdown-item hs-has-sub-menu">
                  <a id="navLinkBlogList" class="nav-link u-header__sub-menu-nav-link"
                     href="/about#partenaires"
                     aria-haspopup="true"
                     aria-expanded="false"
                     aria-controls="navSubmenuBlogList">
                     Nos partenaires
                    <i class="fa fa-angle-right u-header__sub-menu-nav-link-icon"></i>
                  </a> --}}

                  <!-- Submenu (level 2) -->
                  {{-- <ul id="navSubmenuBlogList" class="hs-sub-menu list-unstyled u-header__sub-menu u-header__sub-menu-offset" style="min-width: 220px;"
                      aria-labelledby="navLinkBlogList">
                    <li class="dropdown-item u-header__sub-menu-list-item">
                      <a class="nav-link u-header__sub-menu-nav-link" href="https://htmlstream.com/preview/space-v1.6.1/html/blog/list-left-sidebar.html">Left Sidebar</a>
                    </li>
                    <li class="dropdown-item u-header__sub-menu-list-item">
                      <a class="nav-link u-header__sub-menu-nav-link" href="https://htmlstream.com/preview/space-v1.6.1/html/blog/list-right-sidebar.html">Right Sidebar</a>
                    </li>
                    <li class="dropdown-item u-header__sub-menu-list-item">
                      <a class="nav-link u-header__sub-menu-nav-link" href="https://htmlstream.com/preview/space-v1.6.1/html/blog/list-full-width.html">Full Width</a>
                    </li>
                  </ul> --}}
                  <!-- End Submenu (level 2) -->
                {{-- </li> --}}
                <!-- List -->

                <!-- Masonry -->
                <li class="dropdown-item hs-has-sub-menu">
                  {{-- <a id="navLinkBlogGridMinimal" class="nav-link u-header__sub-menu-nav-link"
                     href="/about#projets"
                     aria-haspopup="true"
                     aria-expanded="false"
                     aria-controls="navSubmenuBlogGridMinimal">
                     Nos projets
                    <i class="fa fa-angle-right u-header__sub-menu-nav-link-icon"></i>
                  </a> --}}

                  <!-- Submenu (level 2) -->
                  {{-- <ul id="navSubmenuBlogGridMinimal" class="hs-sub-menu list-unstyled u-header__sub-menu u-header__sub-menu-offset" style="min-width: 220px;"
                      aria-labelledby="navLinkBlogGridMinimal">
                    <li class="dropdown-item u-header__sub-menu-list-item">
                      <a class="nav-link u-header__sub-menu-nav-link" href="https://htmlstream.com/preview/space-v1.6.1/html/blog/masonry-left-sidebar.html">Left Sidebar</a>
                    </li>
                    <li class="dropdown-item u-header__sub-menu-list-item">
                      <a class="nav-link u-header__sub-menu-nav-link" href="https://htmlstream.com/preview/space-v1.6.1/html/blog/masonry-right-sidebar.html">Right Sidebar</a>
                    </li>
                    <li class="dropdown-item u-header__sub-menu-list-item">
                      <a class="nav-link u-header__sub-menu-nav-link" href="https://htmlstream.com/preview/space-v1.6.1/html/blog/masonry-full-width.html">Full Width</a>
                    </li>
                  </ul> --}}
                  <!-- End Submenu (level 2) -->
                </li>
                <!-- Masonry -->

                <!-- Single Article -->
                {{-- <li class="dropdown-item hs-has-sub-menu">
                  <a id="navLinkBlogGridMasonry" class="nav-link u-header__sub-menu-nav-link" href="javascript:;"
                     aria-haspopup="true"
                     aria-expanded="false"
                     aria-controls="navSubmenuBlogGridMasonry">
                    Single Article
                    <i class="fa fa-angle-right u-header__sub-menu-nav-link-icon"></i>
                  </a>

                  <!-- Submenu (level 2) -->
                  <ul id="navSubmenuBlogGridMasonry" class="hs-sub-menu list-unstyled u-header__sub-menu u-header__sub-menu-offset" style="min-width: 220px;"
                      aria-labelledby="navLinkBlogGridMasonry">
                    <li class="dropdown-item u-header__sub-menu-list-item">
                      <a class="nav-link u-header__sub-menu-nav-link" href="https://htmlstream.com/preview/space-v1.6.1/html/blog/single-article-classic.html">Classic</a>
                    </li>
                    <li class="dropdown-item u-header__sub-menu-list-item">
                      <a class="nav-link u-header__sub-menu-nav-link" href="https://htmlstream.com/preview/space-v1.6.1/html/blog/single-article-simple.html">Simple</a>
                    </li>
                  </ul>
                  <!-- End Submenu (level 2) -->
                </li> --}}
                <!-- Single Article -->
              </ul>
              <!-- End Submenu -->
            </li>
            <!-- End Blog -->

            <!-- Shop -->
            <li class="nav-item hs-has-sub-menu u-header__nav-item"
                data-event="hover"
                data-animation-in="fadeInUp"
                data-animation-out="fadeOut">
              <a id="shopMegaMenu" class="nav-link u-header__nav-link"
                 href="devis"
                 aria-haspopup="true"
                 aria-expanded="false"
                 aria-labelledby="shopSubMenu">
                Demande de devis
                {{-- <i class="fa fa-angle-down u-header__nav-link-icon"></i> --}}
              </a>

              <!-- Shop - Submenu -->
              {{-- <ul id="shopSubMenu" class="list-inline hs-sub-menu u-header__sub-menu mb-0" style="min-width: 220px;"
                  aria-labelledby="shopMegaMenu">
                <li class="dropdown-item u-header__sub-menu-list-item py-0">
                  <a class="nav-link u-header__sub-menu-nav-link" href="https://htmlstream.com/preview/space-v1.6.1/html/shop/classic.html">Classic</a>
                </li>
                <li class="dropdown-item u-header__sub-menu-list-item py-0">
                  <a class="nav-link u-header__sub-menu-nav-link" href="https://htmlstream.com/preview/space-v1.6.1/html/shop/single-product.html">Single Product</a>
                </li>
                <li class="dropdown-item u-header__sub-menu-list-item py-0">
                  <a class="nav-link u-header__sub-menu-nav-link" href="https://htmlstream.com/preview/space-v1.6.1/html/shop/checkout.html">Checkout</a>
                </li>
                <li class="dropdown-item u-header__sub-menu-list-item py-0">
                  <a class="nav-link u-header__sub-menu-nav-link" href="https://htmlstream.com/preview/space-v1.6.1/html/shop/empty-cart.html">Empty Cart</a>
                </li>
                <li class="dropdown-item u-header__sub-menu-list-item py-0">
                  <a class="nav-link u-header__sub-menu-nav-link" href="https://htmlstream.com/preview/space-v1.6.1/html/shop/gift-card.html">Gift Card</a>
                </li>
                <li class="dropdown-item u-header__sub-menu-list-item py-0">
                  <a class="nav-link u-header__sub-menu-nav-link" href="https://htmlstream.com/preview/space-v1.6.1/html/shop/order-completed.html">Order Completed</a>
                </li>
              </ul> --}}
            </li>
            <!-- End Shop -->

            <!-- Docs -->
            {{-- <li class="nav-item hs-has-sub-menu u-header__nav-item"
                data-event="hover"
                data-animation-in="fadeInUp"
                data-animation-out="fadeOut">
              <a id="docsMegaMenu" class="nav-link u-header__nav-link" href="javascript:;"
                 aria-haspopup="true"
                 aria-expanded="false"
                 aria-labelledby="docsSubMenu">
                Docs
                <i class="fa fa-angle-down u-header__nav-link-icon"></i>
              </a>

              <!-- Docs - Submenu -->
              <ul id="docsSubMenu" class="list-inline hs-sub-menu u-header__sub-menu mb-0" style="min-width: 260px;"
                  aria-labelledby="docsMegaMenu">
                <li class="dropdown-item u-header__sub-menu-list-item py-0">
                  <a class="nav-link d-block u-header__sub-menu-nav-link" href="https://htmlstream.com/preview/space-v1.6.1/documentation/index.html">
                    <div class="media align-items-center">
                      <img class="max-width-5 mr-3" src="https://htmlstream.com/preview/space-v1.6.1/assets/svg/components/news-dark-icon.svg" alt="Image Description">
                      <div class="media-body">
                        <span class="d-block text-dark font-weight-medium">Documentation</span>
                        <small class="d-block">Development guides</small>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="dropdown-item u-header__sub-menu-list-item py-0">
                  <a class="nav-link d-block u-header__sub-menu-nav-link" href="https://htmlstream.com/preview/space-v1.6.1/starter/index.html">
                    <div class="media align-items-center">
                      <img class="max-width-5 mr-3" src="https://htmlstream.com/preview/space-v1.6.1/assets/svg/components/portfolio-dark-icon.svg" alt="Image Description">
                      <div class="media-body">
                        <span class="d-block text-dark font-weight-medium">Get Started</span>
                        <small class="d-block">Components and snippets</small>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </li> --}}
            <!-- End Docs -->

            <!-- Button -->
            {{-- <li class="nav-item u-header__nav-item-btn">
              <a class="btn btn-sm btn-primary" href="#signupModal" role="button"
                 data-modal-target="#signupModal"
                 data-overlay-color="#151b26">
                <i class="fa fa-user-circle mr-1"></i>
                Signin
              </a>
            </li> --}}
            <!-- End Button -->

            <!-- Search -->
            <li class="nav-item u-header__navbar-icon u-header__navbar-v-divider">
              {{-- <a class="btn btn-xs btn-icon btn-text-dark u-header__search-toggle" href="javascript:;" role="button"
                 aria-haspopup="true"
                 aria-expanded="false"
                 aria-controls="search"
                 data-unfold-target="#search"
                 data-unfold-hide-on-scroll="false"
                 data-unfold-type="css-animation"
                 data-unfold-duration="300"
                 data-unfold-delay="300"
                 data-unfold-animation-in="slideInUp">
                <i class="fa fa-search btn-icon__inner"></i>
              </a> --}}

              <!-- Input -->
              {{-- <form id="search" class="js-focus-state input-group form u-header__search u-unfold--css-animation u-unfold--hidden">
                <input class="form-control form__input" type="search" placeholder="Search Space">
                <div class="input-group-addon u-header__search-addon p-0">
                  <button class="btn btn-primary u-header__search-addon-btn" type="button">
                    <i class="fa fa-search"></i>
                  </button>
                </div>
              </form> --}}
              <!-- End Input -->
            </li>
            <!-- End Search -->
          </ul>
        </div>
        <!-- End Navigation -->

        <ul class="navbar-nav flex-row u-header__secondary-nav">
          <!-- Shopping Cart -->
          <li class="nav-item u-header__navbar-icon-wrapper u-header__navbar-icon">
            <a class="btn btn-sm" href="#signupModal" role="button"
               style="background-color:#00a0e1;"
               data-modal-target="#signupModal"
               data-overlay-color="#00a0e1">
              {{-- <i class="fa fa-user-circle mr-1"></i> --}}
              Tracking
            </a>
          </li>
          <!-- End Shopping Cart -->

          <!-- Account Signin -->
          {{-- <li class="nav-item u-header__navbar-icon">
            <!-- Account Sidebar Toggle Button -->
            <a id="sidebarNavToggler" class="btn btn-xs btn-icon btn-text-dark" href="javascript:;" role="button"
               aria-controls="sidebarContent"
               aria-haspopup="true"
               aria-expanded="false"
               data-unfold-event="click"
               data-unfold-hide-on-scroll="false"
               data-unfold-target="#sidebarContent"
               data-unfold-type="css-animation"
               data-unfold-animation-in="fadeInRight"
               data-unfold-animation-out="fadeOutRight"
               data-unfold-duration="500">
              <i class="fa fa-bars btn-icon__inner font-size-13"></i>
            </a>
            <!-- End Account Sidebar Toggle Button -->
          </li> --}}
          <!-- End Account Signin -->
        </ul>
      </nav>
      <!-- End Nav -->
    </div>
  </div>
</header>
<!-- ========== END HEADER ========== -->
