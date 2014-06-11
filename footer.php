
<div style="clear:both"></div>

<div class="footer container"> 
    <div class="row">

                <div class="span6">
                    <div class="fwidget">

                        <div class="col-l">
                            <h6>公司产品</h6>
                            <?php wp_nav_menu(array(
                                'theme_location' => 'menu-one',
                                'menu_class'=>'',
                                )); ?>

                        </div>
                        <div class="col-r">
                            <h6>&nbsp;</h6>
                            <?php wp_nav_menu(array(
                                'theme_location' => 'menu-two',
                                'menu_class'=>'',
                                )); ?>
                        </div>

                    </div>
                </div>

                <div class="span3">
                    <div class="fwidget">
                        <h6>关注云仓</h6>
                        <?php wp_nav_menu(array(
                            'theme_location' => 'menu-four',
                            'menu_class'=>'',
                            )); ?>
                    </div>
                </div>

                <div class="span3">
                    <div class="fwidget">
                        <h6>更多</h6>
                        <?php wp_nav_menu(array(
                            'theme_location' => 'menu-five',
                            'menu_class'=>'',
                            )); ?>
                    </div>
                </div>

    </div>
    
    <div class="row">
        <div class="span12">
                <div class="copy">
                    <p>
                        Copyright 2013 &copy;
                        <a href="<?php echo home_url(); ?>">云仓科技</a>
                        -
                        <a href="<?php echo get_permalink(32); ?>">关于云仓</a>
                        |
                        <a href="<?php echo get_permalink(326); ?>">联系我们</a>
                    </p>
                </div>
            </div>
        </div>
</div>


</div><!--end wrapper -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-43764656-1', 'galaxyio.com');
  ga('send', 'pageview');

</script>
</body>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/bootstrap.js"></script>

<script src="<?php bloginfo('template_url'); ?>/js/easing.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/jquery.flexslider-min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/custom.js"></script>
<script type="text/javascript" name="baidu-tc-cerfication" src="http://apps.bdimg.com/cloudaapi/lightapp.js#c43da99ec7ca5e0308ac82d323aaba88"></script>
<script type="text/javascript">window.bd && bd._qdc && bd._qdc.init({app_id: 'ddba08471958e194364113d2'});</script>
</html>
