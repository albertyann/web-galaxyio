<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

<head>
	<meta charset="utf-8">
	<title><?php bloginfo( 'name' );?> | <?php bloginfo( 'description' ); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">
	
	<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/css/bootstrap.min.css">

	<!-- Parallax slider -->
	<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/slider.css">
	<!-- Flexslider -->
	<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/flexslider.css">

	<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/css/blue.css">
	<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/bootstrap-responsive.css">

	<link rel="shortcut icon" href="<?php bloginfo( 'template_url' ); ?>/favicon.ico"></head>

<body>
    <div class="wrapper">

        <div class="header">
            <div class="container">
                <div class="span6 cl">
                    <div class="logo">
                        <h1>
                            <a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' );?></a>
                        </h1>
                        <span style="font-family: '宋体';font-size:12px;color:#555;"><?php bloginfo( 'description' ); ?></span>
                    </div>
                </div>
                <div class="lan"><a href="/galaxyio.html">English</a> <span>|</span> <a href="<?php echo home_url(); ?>" class="active">中文</a></div>

                <!-- <div class="span5">
                    <div class="form">
                        <form method="get" id="searchform" action="#" class="form-search">
                            <input type="text" value="" name="s" id="s" class="input-medium">
                            <button type="submit" class="btn">Search</button>
                        </form>
                    </div>
                </div>-->
                
            </div>
            
            <div class="primary-main">
                <div class="navbar">
                        <div class="navbar-inner">
				      <!--   <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					       <span>Menu</span>
				        </a> -->

				
				<div class="nav-collapse">
                                    
<div class="menu_content">
    <!-- 在此处加个判断中英文链接的页面是否一样 -->
    <ul class="menu">
        <li><a href="<?php echo home_url(); ?>" class="home">首页</a></li>
        <li><a href="javascript:void(0);" class="introduce">产品技术</a>
            <div class="double">
                <dl>
                    <dt>
                        存储设备
                    </dt>
                    <dd>
                        <?php 
                            wp_nav_menu( array(
                                    'container' => false,
                                    'menu_class'=>'',
                                    'walker' => new galaxyio_hover_walker(),
                                    'theme_location' => 'menu-one'
                            ));
                        ?>
                    </dd>
                </dl>
                
               <dl>
                    <dt>
                        数据存储与管理软件
                    </dt>
                    <dd> 
                        <?php 
                            wp_nav_menu( array(
                                    'container' => false,
                                    'menu_class'=>'',
                                    'walker' => new galaxyio_hover_walker(),
                                    'theme_location' => 'menu-two'
                            ));
                        ?>
                    </dd>
                </dl>
            </div>
        </li>
        <li><a href="javascript:void(0);" class="news_active introduce">解决方案</a>
            <div>
                <?php 
                    wp_nav_menu( array(
                            'container' => false,
                            'menu_class'=>'',
                            'walker' => new galaxyio_hover_walker(),
                            'theme_location' => 'menu-three'
                    ));
                ?>
            </div>
        </li>
        <li><a href="javascript:void(0);" class="download introduce">关于我们</a>
            <div>
                <?php 
                    wp_nav_menu( array(
                        'container' => false,
                        'menu_class'=>'',
                        'walker' => new galaxyio_hover_walker(),
                        'theme_location' => 'menu-four'
                    ));
                ?>
            </div>
        </li>
        <li><a href="javascript:void(0);" class="about introduce">更多信息</a>
            <div>
                <?php 
                    wp_nav_menu( array(
                        'container' => false,
                        'menu_class'=>'',
                        'walker' => new galaxyio_hover_walker(),
                        'theme_location' => 'menu-five'
                    ));
                ?>
            </div>
        </li>
    </ul>
</div>

				</div>
			</div>
		</div>
            </div>
        </div>
