<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $cakeDescription ?>:
            <?php echo $title_for_layout; ?>
        </title>
        <?php
        echo $this->Html->meta('icon');

        //echo $this->Html->css('cake.generic');
        echo $this->Html->css('http://fonts.googleapis.com/css?family=Droid+Sans:400,700');
        echo $this->Html->css('http://fonts.googleapis.com/css?family=Droid+Serif');
        echo $this->Html->css('http://fonts.googleapis.com/css?family=Boogaloo');
        echo $this->Html->css('http://fonts.googleapis.com/css?family=Economica:700,400italic');
        echo $this->Html->css('ui-lightness/jquery-ui-1.10.0.custom.css');

        echo $this->Html->script("jquery-1.9.0.js");
        echo $this->Html->script("jquery-ui-1.10.0.custom.min.js");
        echo $this->Html->script("util.js");


        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
        <link href="css/bootstrap.css" rel="stylesheet"/>
        <link href="css/bootstrap-responsive.css" rel="stylesheet"/>
        <link href="css/style.css" rel="stylesheet"/>
    </head>
    <body>
        <!--start: Header -->
        <header>

            <!--start: Container -->
            <div class="container">

                <!--start: Row -->
                <div class="row">

                    <!--start: Logo -->
                    <div class="logo span3">
                        <a class="brand" href="#">Mayor<span>Responds</span>.</a>

                    </div>
                    <!--end: Logo -->

                    <!--start: Navigation -->
                    <div class="span9">

                        <div class="navbar navbar-inverse">
                            <div class="navbar-inner">
                                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </a>
                                <div class="nav-collapse collapse">
                                    <ul class="nav">
                                        <li class="active"><a href="index.html">Home</a></li>
                                        <li><a href="#">Cities</a></li>
                                        <li><a href="#">Questions</a></li>

                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--end: Navigation -->

                </div>
                <!--end: Row -->

            </div>
            <!--end: Container-->

        </header>
        <!--end: Header-->
        <!--start: Wrapper-->
        <div id="wrapper">
            <!--start: Container -->
            <div class="container">
                <?php echo $this->Session->flash(); ?>

                <?php echo $this->fetch('content'); ?>


            </div>
        </div>
        <!-- start: Footer -->
        <div id="footer">

            <!-- start: Container -->
            <div class="container">

                <!-- start: Row -->
                <div class="row">

                    <!-- start: About -->
                    <div class="span4">

                        <h3>MayorResponds</h3>

                        <p>
                            <i class="mini-ico-map-marker mini-white"></i>Address
                        </p>
                        <p>
                            <i class="mini-ico-map-marker mini-white"></i>  Bogotá - DC, ADRESSSSSS, USA
                        </p>
                        <p>
                            <i class="ico-z-iphone"></i> Phone: +57 1 888 88 88
                        </p>
                        <p>
                            <i class="mini-ico-print mini-white"></i> Fax: +57 1 888 88 88
                        </p>
                        <p>
                            <i class="mini-ico-envelope mini-white"></i> Email: contact@mayorresponds.org
                        </p>
                        <p>
                            <i class="mini-ico-globe mini-white"></i> Web: mayorresponds.com
                        </p>

                    </div>
                    <!-- end: About -->

                    <!-- start: Latest Tweets -->
                    <div class="span4">

                        <h3>Latest Tweets</h3>

                        <ul id="twitter">

                        </ul>

                        <div class="clear"></div>


                    </div>
                    <!-- end: Latest Tweets -->


                    <!-- start: Follow Us -->
                    <div class="span4">

                        <h3>Follow Us</h3>

                        <div id="social-r" class="tooltips">

                            <a href="#" rel="tooltip" title="Facebook" class="facebook">Facebook</a>
                            <a href="#" rel="tooltip" title="Google Plus" class="googleplus">Google Plus</a>
                            <a href="#" rel="tooltip" title="Twitter" class="twitter">Twitter</a>
                            <a href="#" rel="tooltip" title="Vimeo" class="vimeo">Vimeo</a>
                            <a href="#" rel="tooltip" title="YouTube" class="youtube">YouTube</a>
                            <a href="#" rel="tooltip" title="RSS" class="rss">RSS</a>
                        </div>

                    </div>
                    <!-- end: Follow Us -->

                </div>
                <!-- end: Row -->

            </div>
            <!-- end: Container  -->

        </div>
        <!-- end: Footer -->


        <div id="copyright">

            <!-- start: Container -->
            <div class="container">

                <div class="sixteen columns">
                    <p>

                    </p>
                </div>

            </div>
            <!-- end: Container  -->

        </div>
        <script src="js/twitter.js"></script>

        <!-- end: Copyright -->
        <?php echo DEBUG > 0 ? $this->element('sql_dump') : ''; ?>
    </body>
</html>
