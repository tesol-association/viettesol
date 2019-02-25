<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <title>@yield('title')</title>

  <!-- Google font -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700%7CMuli:400,700" rel="stylesheet">

  <!-- Bootstrap -->
  <link type="text/css" rel="stylesheet" href="{{ asset('home/css/bootstrap.min.css') }}" />

  <!-- Font Awesome Icon -->
  <link rel="stylesheet" href="{{ asset('home/css/font-awesome.min.css') }}">

  <!-- Custom stlylesheet -->
  <link type="text/css" rel="stylesheet" href="{{ asset('home/css/style.css') }}" />
  @yield('css')
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
  <!-- HEADER -->
  <header id="header">
    <!-- NAV -->
    <div id="nav">
      <!-- Top Nav -->
      <div id="nav-top">
        <div class="container">
          
          <!-- logo -->
          <div class="nav-logo">
            <a href="index.html" class="logo"><img src="{{ asset('home/img/banner.jpg') }}" alt=""></a>
          </div>
          <!-- /logo -->

          <!-- search & aside toggle -->
          <div class="nav-btns">
            <button class="aside-btn"><i class="fa fa-bars"></i></button>
            <button class="search-btn"><i class="fa fa-search"></i></button>
            <div id="nav-search">
              <form>
                <input class="input" name="search" placeholder="Enter your search...">
              </form>
              <button class="nav-close search-close">
                <span></span>
              </button>
            </div>
          </div>
          <!-- /search & aside toggle -->
        </div>
      </div>
      <!-- /Top Nav -->

      <!-- Main Nav -->
      <div id="nav-bottom">
        <div class="container">
          <!-- nav -->
          <ul class="nav-menu">
            <li class="has-dropdown">
              <a href="index.html">Home</a>
              <div class="dropdown">
                <div class="dropdown-body">
                  <ul class="dropdown-list">
                    <li><a href="category.html">Category page</a></li>
                    <li><a href="blog-post.html">Post page</a></li>
                    <li><a href="author.html">Author page</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="contact.html">Contacts</a></li>
                    <li><a href="blank.html">Regular</a></li>
                  </ul>
                </div>
              </div>
            </li>
            <li class="has-dropdown">
              <a href="index.html">Fashion</a>
              <div class="dropdown">
                <div class="dropdown-body">
                  <ul class="dropdown-list">
                    <li><a href="category.html">Category page</a></li>
                    <li><a href="blog-post.html">Post page</a></li>
                    <li><a href="author.html">Author page</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="contact.html">Contacts</a></li>
                    <li><a href="blank.html">Regular</a></li>
                  </ul>
                </div>
              </div>
            </li>
            <li class="has-dropdown">
              <a href="index.html">Home</a>
              <div class="dropdown">
                <div class="dropdown-body">
                  <ul class="dropdown-list">
                    <li><a href="category.html">Category page</a></li>
                    <li><a href="blog-post.html">Post page</a></li>
                    <li><a href="author.html">Author page</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="contact.html">Contacts</a></li>
                    <li><a href="blank.html">Regular</a></li>
                  </ul>
                </div>
              </div>
            </li>
            <li class="has-dropdown">
              <a href="index.html">Technology</a>
              <div class="dropdown">
                <div class="dropdown-body">
                  <ul class="dropdown-list">
                    <li><a href="category.html">Category page</a></li>
                    <li><a href="blog-post.html">Post page</a></li>
                    <li><a href="author.html">Author page</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="contact.html">Contacts</a></li>
                    <li><a href="blank.html">Regular</a></li>
                  </ul>
                </div>
              </div>
            </li>
            <li class="has-dropdown">
              <a href="index.html">Healthy</a>
              <div class="dropdown">
                <div class="dropdown-body">
                  <ul class="dropdown-list">
                    <li><a href="category.html">Category page</a></li>
                    <li><a href="blog-post.html">Post page</a></li>
                    <li><a href="author.html">Author page</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="contact.html">Contacts</a></li>
                    <li><a href="blank.html">Regular</a></li>
                  </ul>
                </div>
              </div>
            </li>
            <li class="has-dropdown">
              <a href="index.html">Travel</a>
              <div class="dropdown">
                <div class="dropdown-body">
                  <ul class="dropdown-list">
                    <li><a href="category.html">Category page</a></li>
                    <li><a href="blog-post.html">Post page</a></li>
                    <li><a href="author.html">Author page</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="contact.html">Contacts</a></li>
                    <li><a href="blank.html">Regular</a></li>
                  </ul>
                </div>
              </div>
            </li>
          </ul>
          <!-- /nav -->
        </div>
      </div>
      <!-- /Main Nav -->

      <!-- Aside Nav -->
      <div id="nav-aside">
        <ul class="nav-aside-menu">
          <li><a href="index.html">Home</a></li>
          <li class="has-dropdown"><a>Categories</a>
            <ul class="dropdown">
              <li><a href="#">Lifestyle</a></li>
              <li><a href="#">Fashion</a></li>
              <li><a href="#">Technology</a></li>
              <li><a href="#">Travel</a></li>
              <li><a href="#">Health</a></li>
            </ul>
          </li>
          <li><a href="about.html">About Us</a></li>
          <li><a href="contact.html">Contacts</a></li>
          <li><a href="#">Advertise</a></li>
        </ul>
        <button class="nav-close nav-aside-close"><span></span></button>
      </div>
      <!-- /Aside Nav -->
    </div>
    <!-- /NAV -->
  </header>
  <!-- /HEADER -->

    <!-- SECTION -->
      <div class="section">
        <!-- container -->
        <div class="container">
          @yield('slide')
        </div>
       <!-- /container -->
      </div>   
    <!-- /SECTION -->

   <!-- SECTION -->
  <div class="section">
    <!-- container -->
    <div class="container">
      <!-- row -->
      <div class="row">
        <div class="col-md-8">
          @yield('content')
        </div>  
        <div class="col-md-4">
          <!-- ad widget-->
          <div class="aside-widget text-center">
            <a href="#" style="display: inline-block;margin: auto;">
              <img class="img-responsive" src="{{ asset('home/img/ad-3.jpg') }}" alt="">
            </a>
          </div>
          <!-- /ad widget -->

          <!-- ad widget-->
          <div class="aside-widget text-center">
            <a href="#" style="display: inline-block;margin: auto;">
              <img class="img-responsive" src="{{ asset('home/img/ad-3.jpg') }}" alt="">
            </a>
          </div>
          <!-- /ad widget -->

          <!-- ad widget-->
          <div class="aside-widget text-center">
            <a href="#" style="display: inline-block;margin: auto;">
              <img class="img-responsive" src="{{ asset('home/img/ad-3.jpg') }}" alt="">
            </a>
          </div>
          <!-- /ad widget -->
                    
                    <!-- ad widget-->
          <div class="aside-widget text-center">
            <a href="#" style="display: inline-block;margin: auto;">
              <img class="img-responsive" src="{{ asset('home/img/ad-3.jpg') }}" alt="">
            </a>
          </div>
          <!-- /ad widget -->
          <!-- ad widget-->
          <div class="aside-widget text-center">
            <a href="#" style="display: inline-block;margin: auto;">
              <img class="img-responsive" src="{{ asset('home/img/ad-3.jpg') }}" alt="">
            </a>
          </div>
          <!-- /ad widget -->
        </div>
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /SECTION -->

 
  <!-- FOOTER -->
  <footer id="footer">
    <!-- container -->
    <div class="container">
      
      <!-- row -->
      <div class="footer-bottom row">
        <div class="col-md-6 col-md-push-6">
          <ul class="footer-nav">
            <li><a href="index.html">Home</a></li>
            <li><a href="about.html">About Us</a></li>
            <li><a href="contact.html">Contacts</a></li>
            <li><a href="#">Advertise</a></li>
            <li><a href="#">Privacy</a></li>
          </ul>
        </div>
        <div class="col-md-6 col-md-pull-6">
          <div class="footer-copyright">
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          </div>
        </div>
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </footer>
  <!-- /FOOTER -->

  <!-- jQuery Plugins -->
  <script src="{{ asset('home/js/jquery.min.js') }}"></script>
  <script src="{{ asset('home/js/bootstrap.min.js') }}"></script>
  <!-- <script src="{{ asset('js/jquery.stellar.min.js') }}"></script> -->
  <script src="{{ asset('home/js/main.js') }}"></script>
  @yield('js')
</body>

</html>
