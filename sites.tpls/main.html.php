<!DOCTYPE html>
<html>
<head>
	<title><?= $this -> resp -> content -> title ?></title>
	<meta charset="utf-8">
	<meta name="robots" content="index, follow">
	<meta name="description" content="<?= $this -> resp -> content -> description  ?>">
	<meta name="keywords" content="<?= $this -> resp -> content -> keywords ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<link rel="icon" href="favicon.ico" type="image/x-icon" />
	 <!-- link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css" -->
	<!-- link rel="stylesheet" href="<?= WWW_DUSTS ?>externals/jquery-ui.css" -->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/sunny/jquery-ui.css">
	<!-- script src="//code.jquery.com/jquery-1.10.2.js"></script -->
	<!--script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script -->	
	<!-- script src="<?= WWW_DUSTS ?>externals/jquery-ui.js"></script -->
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<style type="text/css">
<?php

	include 'ui/main.css.php';
	
	if ( WORK_MODE == 'LOCAL' ) {
    
		include $this -> _c [ 'dir_commons' ] . 'css/debug.css';
	}
	
	while ( $this -> resp -> files_css -> takeNext() ) {

		if ( ! is_array (  $this -> resp -> files_css -> piece ) ) { 
		
			include $this -> resp -> files_css -> piece;
			
		} else {
		
			include $this -> resp -> files_css -> piece [ 'file' ];		
		}
	}
?>
	</style>
	<script type="text/javascript">	
<?php 

	include $this -> _c [ 'dir_commons' ] . 'js/to_new_window.jq.dr.js';
	include $this -> _c [ 'dir_commons' ] . 'js/extends.js';	

	while ( $this -> resp -> files_js -> takeNext() ) include $this -> resp -> files_js -> piece;
?>
		$(document).ready ( function() {

// 			$( document ).tooltip();
<?php

	include $this -> _c [ 'dir_commons' ] . 'js/to_new_window.jq.dr.js';
		
	while ( $this -> resp -> files_js_jqdr -> takeNext() ) include $this -> resp -> files_js_jqdr -> piece;
?>
		});
	</script>
</head>
<body style="margin-top: 0">
<!-- slankiojantis meniu ir login mygtukai -->
<?php
        if ( 
            ! 
                in_array ( 
                
                    _cfihod ( $_GET, 'bu17', 'nenurodytas' )
                    , array ( 
                        'registracija'
                        , 'reg'
                        , 'taisykles'
                        , 'registracija-tvirtink'
                        , 'registracijos-patvirtinimas' 
                    ) 
                ) 
        ) {

            include DIR_MAIN . 'views/login_block.html.php';
        }
?>
<!-- slankiojantis meniu ir login mygtukai END -->
<!-- PAGE TOP TITLE -->
	<section id='page-top'>
		<section id='page-top-title'>
			<h1>
				<div class="title-text-left"><?= $this -> opt -> left_title ?></div>
				<div class="title-text-middle"><?= $this -> opt -> main_title ?></div>
				<div class="title-letter"><?= $this -> opt -> title_letter ?></div>
				<div class="title-text-right"><?= $this -> opt -> right_title ?></div>
			</h1>
		</section>
		<a class="osd_help_button" id="osd_help" href='javascript:void(0)'></a>
		<div id="help_container">
			<div class="help_box">
				<span id="help_text">
					<p><span class="osd_first_letter">T</span>EST</p>
                        <?php
                        
                        if ( _cfihod ( _cfihod ( _cfihod ( $this,  'resp', array() ), 'content', array() ), 'tpl_info', false ) ) {

				include $this -> resp -> content -> tpl_info;
			    
                        } else {
			
				include 'ai.html.php';
			}
                    ?>
				</span> 
			</div>
		</div>
	</section>
<!-- PAGE TOP TITLE END -->
	<div style="height: 90px;"></div>
	<div id="page">
<?php
	if ( _have_value ( ( array ) $this -> resp -> content, 'control_tpl' ) )  include $this -> resp -> content -> control_tpl;
?>
		<div  id="tabs">
 <?php
 
           // echo '$this -> _u -> status: ' . $this -> _u -> status;
 
            if ( 
                        ( $this -> _u -> status == USER_LOGGED_IN ) 
                    || 
                        in_array ( 
                            _cfihod ( $_GET, 'bu17', 'nenurodytas' )
                            , array ( 
                                'registracija'
                                , 'reg'
                                , 'taisykles'
                                , 'registracija-tvirtink'
                                , 'registracijos-patvirtinimas'
                            ) 
                        ) 
            ) {
            
                require $this -> resp -> content -> tpl;
            }
      
			while ( $this -> resp -> content -> tpl_addls -> takeNext() ) include $this -> resp -> content -> tpl_addls -> piece;
            
			if ( _have_value ( ( array ) $this -> resp -> content, 'dialogs_tpl' ) )  include $this -> resp -> content -> dialogs_tpl;
?> 
		</div>
    </div>

 
    <div style="height: 300px"></div>
    
<?php    

	if ( WORK_MODE == 'LOCAL' ) {
	
		$this -> _s -> log -> see();
	}
?>	

</body>
</html>