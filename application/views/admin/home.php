<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$title?> </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url();?>assets/images/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="<?=base_url();?>assets/vendor/waves/waves.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/vendor/owlcarousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/style.css">
</head>

<body>

    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>

    <div id="main-wrapper pt-0">

        <div class="header landing_page">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <nav class="navbar navbar-expand-lg navbar-light px-0">
                            <a class="navbar-brand" href="index.html"><img src="<?=base_url();?>assets/images/w_logo.png" alt="">
                                <span>Tradient</span></a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#" data-scroll-nav="0">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" data-scroll-nav="1">Market</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" data-scroll-nav="2">Portfolio</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" data-scroll-nav="3">Testimonial</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" data-scroll-nav="4">Contact</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="dashboard_log">
                                <div class="d-flex align-items-center">
                                    <div class="header_auth">
                                        <a href="<?=base_url('index.php/');?>signin" class="btn btn-success">Sign In</a>
                                        <a href="<?=base_url('index.php/');?>signup" class="btn btn-outline-primary">Sign Up</a>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="intro section-padding position-relative" id="intro" data-scroll-index="0">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-xl-6 col-md-6">
                        <div class="intro-content">
                            <h2>Buy and sell <br>cryptocurrency</h2>
                            <p>Fast and secure way to purchase or exchange 150+ cryptocurrencies</p>
                            <a href="#" class="btn">GET STARTED</a>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 py-md-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="buy-sell-widget">
                                    <form method="post" name="myform" class="currency_validate">
                                        <div class="mb-3">
                                            <label class="mr-sm-2">Currency</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text"><i class="cc BTC-alt"></i></label>
                                                </div>
                                                <select name='currency' class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="bitcoin">Bitcoin</option>
                                                    <option value="litecoin">Litecoin</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="mr-sm-2">Payment Method</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text"><i class="fa fa-bank"></i></label>
                                                </div>
                                                <select class="form-control" name="method">
                                                    <option value="">Select</option>
                                                    <option value="bank">Bank ********45845</option>
                                                    
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="mr-sm-2">Enter your amount</label>
                                            <div class="input-group">
                                                <input type="text" name="currency_amount" class="form-control"
                                                    placeholder="0.0214 BTC">
                                                <input type="text" name="usd_amount" class="form-control"
                                                    placeholder="125.00 USD">
                                            </div>
                                            <div class="d-flex justify-content-between mt-3">
                                                <p class="mb-0">Monthly Limit</p>
                                                <h6 class="mb-0">$49750 remaining</h6>
                                            </div>
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-success btn-block">Exchange
                                            Now</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="market section-padding page-section" data-scroll-index="1">
            <div class="container">
                <div class="row py-lg-5 justify-content-center">
                    <div class="col-xl-6">
                        <div class="section_heading">
                            <span>Explore</span>
                            <h3>The World's Leading Cryptocurrency Exchange</h3>
                            <p>Trade Bitcoin, ETH, and hundreds of other cryptocurrencies in minutes.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="market-table">
                                    <div class="table-responsive">
                                        <table class="table mb-0 table-responsive-sm">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Price</th>
                                                    <th>Change</th>
                                                    <th>Chart</th>
                                                    <th>Trade</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</span>
                                                    </td>
                                                    <td class="coin_icon">
                                                        <i class="cc BTC"></i>
                                                        <span>Bitcoin <b>BTC</b></span>
                                                    </td>

                                                    <td>
                                                        USD 680,175.06
                                                    </td>
                                                    <td>
                                                        <span class="text-success">+1.13%</span>
                                                    </td>
                                                    <td> <span class="sparkline8"></span></td>
                                                    <td><a href="#" class="btn btn-success">Buy</a></td>
                                                </tr>
                                                <tr>
                                                    <td>2</span>
                                                    </td>
                                                    <td class="coin_icon">
                                                        <i class="cc ETH"></i>
                                                        <span>Ethereum <b>ETH</b></span>
                                                    </td>

                                                    <td>
                                                        USD 680,175.06
                                                    </td>
                                                    <td>
                                                        <span class="text-success">+1.13%</span>
                                                    </td>
                                                    <td> <span class="sparkline8"></span></td>
                                                    <td><a href="#" class="btn btn-success">Buy</a></td>
                                                </tr>
                                                <tr>
                                                    <td>3</span>
                                                    </td>
                                                    <td class="coin_icon">
                                                        <i class="cc BCH-alt"></i>
                                                        <span>Bitcoin Cash <b>BCH</b></span>
                                                    </td>

                                                    <td>
                                                        USD 680,175.06
                                                    </td>
                                                    <td>
                                                        <span class="text-success">+1.13%</span>
                                                    </td>
                                                    <td> <span class="sparkline8"></span></td>
                                                    <td><a href="#" class="btn btn-success">Buy</a></td>
                                                </tr>
                                                <tr>
                                                    <td>4</span>
                                                    </td>
                                                    <td class="coin_icon">
                                                        <i class="cc LTC"></i>
                                                        <span>Litecoin <b>LTC</b></span>
                                                    </td>

                                                    <td>
                                                        USD 680,175.06
                                                    </td>
                                                    <td>
                                                        <span class="text-danger">-0.47%</span>
                                                    </td>
                                                    <td> <span class="sparkline8"></span></td>
                                                    <td><a href="#" class="btn btn-success">Buy</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="features section-padding">
            <div class="container">
                <div class="row py-lg-5 justify-content-center">
                    <div class="col-xl-6">
                        <div class="section_heading">
                            <span>Features</span>
                            <h3>The most trusted cryptocurrency platform</h3>
                            <p>Here are a few reasons why you should choose Coinbase</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="features-content">
                            <span><i class="fa fa-shield"></i></span>
                            <h4>Secure storage</h4>
                            <p>We store the vast majority of the digital assets in secure offline storage.</p>
                            <a href="#">Learn more <i class="la la-angle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="features-content">
                            <span><i class="fa fa-cubes"></i></span>
                            <h4>Protected by insurance</h4>
                            <p>Cryptocurrency stored on our servers is covered by our insurance policy.</p>
                            <a href="#">Learn more <i class="la la-angle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="features-content">
                            <span><i class="fa fa-life-ring"></i></span>
                            <h4>Industry best practices</h4>
                            <p>Tradientsupports a variety of the most popular digital currencies.</p>
                            <a href="#">Learn more <i class="la la-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="portfolio section-padding" data-scroll-index="2">
            <div class="container">
                <div class="row py-lg-5 justify-content-center">
                    <div class="col-xl-6">
                        <div class="section_heading">
                            <span>Join Us</span>
                            <h3>Create your cryptocurrency portfolio today</h3>
                            <p>Tradient has a variety of features that make it the best place to start trading</p>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-xl-5 col-md-6">
                        <div class="portfolio_list">
                            <div class="media">
                                <span class="port-icon"> <i class="la la-bar-chart"></i></span>
                                <div class="media-body">
                                    <h4>Manage your portfolio</h4>
                                    <p>Buy and sell popular digital currencies, keep track of them in the one place.</p>
                                </div>
                            </div>
                            <div class="media">
                                <span class="port-icon"> <i class="la la-calendar-check-o"></i></span>
                                <div class="media-body">
                                    <h4>Recurring buys</h4>
                                    <p>Invest in cryptocurrency slowly over time by scheduling buys daily, weekly, or
                                        monthly.
                                    </p>
                                </div>
                            </div>
                            <div class="media">
                                <span class="port-icon"> <i class="la la-lock"></i></span>
                                <div class="media-body">
                                    <h4>Vault protection</h4>
                                    <p>For added security, store your funds in a vault with time delayed withdrawals.
                                    </p>
                                </div>
                            </div>
                            <div class="media">
                                <span class="port-icon"> <i class="la la-android"></i></span>
                                <div class="media-body">
                                    <h4>Mobile apps</h4>
                                    <p>Stay on top of the markets with the Tradient app for <a href="#">Android</a> or
                                        <a href="#">iOS</a>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 col-md-6">
                        <div class="portfolio_img">
                            <img src="./images/portfolio.png" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="testimonial section-padding" data-scroll-index="3">
            <div class="container">
                <div class="row py-lg-5 justify-content-center">
                    <div class="col-xl-6">
                        <div class="section_heading">
                            <span>What's Say</span>
                            <h3>Trusted by 2 million customers</h3>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-md-11">
                        <div class="testimonial-content">
                            <div class="owl-carousel owl-theme">
                                <div class="row align-items-center">
                                    <div class="col-xl-6 col-md-6">
                                        <div class="customer-img">
                                            <img class="img-fluid" src="./images/testimonial/1.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="customer-review">
                                            <img class="img-fluid" src="./images/brand/2.webp" alt="">
                                            <p>Integrating Tradient services into Trezor Wallet's exchange has been a
                                                great success for all parties, especially the users.
                                            </p>
                                            <div class="customer-info">
                                                <h5>Mr John Doe</h5>
                                                <p>CEO, Example Company</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-xl-6 col-md-6">
                                        <div class="customer-img">
                                            <img class="img-fluid" src="./images/testimonial/2.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="customer-review">
                                            <img class="img-fluid" src="./images/brand/3.webp" alt="">
                                            <p>MEW is excited to bring Tradient’s extensive range of crypto assets,
                                                competitive rates and seamless swap functionality</p>
                                            <div class="customer-info">
                                                <h5>Mr Abraham</h5>
                                                <p>CEO, Example Company</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="contact-form section-padding" data-scroll-index="4">
            <div class="container">
                <div class="row py-lg-5 justify-content-center">
                    <div class="col-xl-6">
                        <div class="section_heading">
                            <span>Ask Question</span>
                            <h3>Let us hear from you directly!</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-md-4 col-sm-4">
                        <div class="info-list">
                            <h4 class="mb-3">Address</h4>
                            <ul>
                                <li><i class="fa fa-map-marker"></i> California, USA</li>
                                <li><i class="fa fa-phone"></i> (+880) 1243 665566</li>
                                <li><i class="fa fa-envelope"></i> hello@example.com</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-8 col-md-8 col-sm-8">
                        <form method="post" name="myform" class="contact_validate">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="contactName">
                                            Full name
                                        </label>
                                        <input type="text" class="form-control" id="contactName" placeholder="Full name"
                                            name="firstname">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="contactEmail">
                                            Email
                                        </label>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="hello@domain.com">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <textarea class="form-control p-3" name="message" rows="5"
                                            placeholder="Tell us what we can help you with!"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary px-4">
                                Send message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-md-6">
                        <div class="footer-link text-left">
                            <a href="#" class="m_logo"><img src="./images/w_logo.png" alt=""></a>
                            <a href="about.html">About</a>
                            <a href="privacy-policy.html">Privacy Policy</a>
                            <a href="term-condition.html">Term & Service</a>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 text-lg-right text-center">
                        <div class="social">
                            <a href="#"><i class="fa fa-youtube-play"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-xl-12 text-center text-lg-right">
                        <div class="copy_right text-center text-lg-center">
                            Copyright © 2019 Quixlab. All Rights Reserved.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="cookie_alert">

        <div class="alert alert-light fade show">
            <i class="la la-close" data-dismiss="alert"></i>
            <p>
                We use cookies to enhance your experience. By using Tradient, you agree to our <a href="#">Terms of
                    Use</a> and <a href="#">Privacy
                    Policy</a>
            </p>
            <button class="btn btn-success btn-block">Accept</button>
        </div>
    </div>


    <!-- <div class="bg_icons"></div> -->



    <script src="<?=base_url();?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?=base_url();?>assets/vendor/waves/waves.min.js"></script>

    <script src="<?=base_url();?>assets/vendor/owlcarousel/js/owl.carousel.min.js"></script>
    <script src="<?=base_url();?>assets/js/plugins/owl-carousel-init.js"></script>
    <script src="<?=base_url();?>assets/vendor/scrollit/scrollIt.js"></script>
    <script src="<?=base_url();?>assets/js/plugins/scrollit-init.js"></script>

    <!-- Chart sparkline plugin files -->
    <script src="<?=base_url();?>assets/vendor/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="<?=base_url();?>assets/js/plugins/sparkline-init.js"></script>

    <script src="<?=base_url();?>assets/vendor/validator/jquery.validate.js"></script>
    <script src="<?=base_url();?>assets/vendor/validator/validator-init.js"></script>
    <script src="<?=base_url();?>assets/js/scripts.js"></script>
</body>

</html>
