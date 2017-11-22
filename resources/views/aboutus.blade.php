<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tranquilo Property</title>

    @include('layouts.tranquilo-core-sheets')

    </head>
    <body>
    
    <header class="navbar navbar-inverse navbar-fixed-top wet-asphalt" role="banner">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{!! url('/') !!}">
                    <img src="{!! asset('myasset/images/tranquilo_mini.png') !!}" width="40%">
                </a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{!! url('/') !!}"><i class="fa icon-home"></i>Home</a></li>
                    <li><a href="{!! url('/property') !!}">Properties</a></li>
                    <li class="active"><a href="{!! url('/aboutus') !!}">About Us</a></li>
                    <li><a href="{!! url('/contactus') !!}"><i class="fa icon-phone"></i>Contact</a></li>
                    @guest
                    <li><a href="{!! route('register') !!}">Sign Up</a></li>
                    @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown">{!! Auth::user()->name !!} <i class="icon-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{!! url('/home') !!}"><i class="fa icon-th-large"></i> Tranquilo Panel</a></li>
                            <li><a href="{!! url('/home') !!}"><i class="fa icon-user"></i> Profile</a></li>
                            <li><a href="{!! route('logout') !!}"><i class="fa icon-signout"></i>Sign Out</a></li>
                        </ul>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </header>
    
    <section id="main-slider" class="no-margin">
        
    </section><!--/#services-->

    <div class="layout">
        <div class="wrapper row2">
          <div id="container" class="clear">
            <div id="about-us" class="clear">
              
              <section id="about-intro" class="clear">
                <h2><b>About Us</b></h2>
                <img src="{!! asset('myasset/images/house.jpg') !!}" alt="">
                <p>We provide service for people who have a problem in searching,
                renting and advertising house. Throughout this project, involved contributor or
                an organization which is Mosque community. This system is actually to help
                Muslims community to find and rent suitable house nearby them. Furthermore, this
                system also opens big chance for helping Muslims community to do business and
                uphold Muslims tradition (Prophet&#8217;s Sunnah) indirectly. </p>
              </section>
              
              <section id="team">
                <h2 class="section-title">Our Team</h2>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <img src="{!! asset('myasset/images/piyad.jpg') !!}" class="img-thumbnail" width="30%" alt="">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <img src="{!! asset('myasset/images/piyad.jpg') !!}" class="img-thumbnail" width="30%" alt="">
                    </div>
                </div>
              </section>
              
            </div>
          </div>
        </div>
    </div>

    <br><br><br>

    <section id="bottom" class="wet-asphalt">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <h4>About Us</h4>
                    <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.</p>
                    <p>Pellentesque habitant morbi tristique senectus.</p>
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                    <h4>Company</h4>
                    <div>
                        <ul class="arrow">
                            <li><a href="#">Company Overview</a></li>
                            <li><a href="#">Meet The Team</a></li>
                            <li><a href="#">Our Awesome Partners</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Frequently Asked Questions</a></li>
                            <li><a href="#">Conatct Us</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms of Use</a></li>
                            <li><a href="#">Copyright</a></li>
                        </ul>
                    </div>
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                    <h4>Latest Blog</h4>
                    <div>
                        <div class="media">
                            <div class="pull-left">
                                <img src="images/blog/thumb1.jpg" alt="">
                            </div>
                            <div class="media-body">
                                <span class="media-heading"><a href="#">Pellentesque habitant morbi tristique senectus</a></span>
                                <small class="muted">Posted 17 Aug 2013</small>
                            </div>
                        </div>
                        <div class="media">
                            <div class="pull-left">
                                <img src="images/blog/thumb2.jpg" alt="">
                            </div>
                            <div class="media-body">
                                <span class="media-heading"><a href="#">Pellentesque habitant morbi tristique senectus</a></span>
                                <small class="muted">Posted 13 Sep 2013</small>
                            </div>
                        </div>
                        <div class="media">
                            <div class="pull-left">
                                <img src="images/blog/thumb3.jpg" alt="">
                            </div>
                            <div class="media-body">
                                <span class="media-heading"><a href="#">Pellentesque habitant morbi tristique senectus</a></span>
                                <small class="muted">Posted 11 Jul 2013</small>
                            </div>
                        </div>
                    </div>  
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                    <h4>Address</h4>
                    <address>
                        <strong>Twitter, Inc.</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        <abbr title="Phone">P:</abbr> (123) 456-7890
                    </address>
                    <h4>Newsletter</h4>
                    <form role="form">
                        <div class="input-group">
                            <input type="text" class="form-control" autocomplete="off" placeholder="Enter your email">
                            <span class="input-group-btn">
                                <button class="btn btn-danger" type="button">Go!</button>
                            </span>
                        </div>
                    </form>
                </div> <!--/.col-md-3-->
            </div>
        </div>
    </section><!--/#bottom-->

    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2013 <a target="_blank" href="http://shapebootstrap.net/" title="Free Twitter Bootstrap WordPress Themes and HTML templates">ShapeBootstrap</a>. All Rights Reserved.
                </div>
                <div class="col-sm-6">
                    <ul class="pull-right">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Faq</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a id="gototop" class="gototop" href="#"><i class="icon-chevron-up"></i></a></li><!--#gototop-->
                    </ul>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->

    <script src="myasset/js/jquery.js"></script>
    <script src="myasset/js/bootstrap.min.js"></script>
    <script src="myasset/js/jquery.prettyPhoto.js"></script>
    <script src="myasset/js/main.js"></script>
</body>
</html>