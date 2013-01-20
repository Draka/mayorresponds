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
$cakeDescription = __('Mayor Responds');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- <html xmlns="http://www.w3.org/1999/xhtml"> -->
<?php echo $this->Facebook->html(); ?>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $cakeDescription ?>:
            <?php echo $title_for_layout; ?>
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta property="og:title" content="Mayor Responds" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="http://www.mayorresponds.org/" />
        <meta property="og:image" content="http://www.mayorresponds.org/img/logo.png" />
        <meta property="og:site_name" content="Mayor Responds" />
        <meta property="og:description" content="Using popular pressure we can make our governors answer our questions."/>
        <meta property="fb:admins" content="691342256" />

        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css('cake.generic');
        echo $this->Html->css('ui-lightness/jquery-ui-1.10.0.custom.css');

        echo $this->Html->script("jquery-1.9.0.js");
        echo $this->Html->script("jquery-ui-1.10.0.custom.min.js");
        echo $this->Html->script("util.js");


        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>
    <body>
        <div id="container">
            <div id="header">
                <div class="logo">Mayor<span>Responds</span>.</div>
                <div class="menu">
                    <table>
                        <tr>
                        <td>
                            <?php echo $this->Html->link(__('Home'), '/'); ?> |
                            <?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index')); ?> |
                            <?php echo $this->Html->link(__('List Questions'), array('controller' => 'questions', 'action' => 'index')); ?>
                        </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div id="content">

                <?php echo $this->Session->flash(); ?>
                <div class="title">
                <?php echo $title_for_layout; ?>
                </div>
                <?php echo $this->fetch('content'); ?>
            </div>
            <div id="footer">

            </div>
        </div>
        <?php echo $this->Facebook->init(); ?>
        <?php echo $this->fetch('scripts_footer'); ?>
    </body>
</html>
