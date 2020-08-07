<?php

	class html_simple {
	
		public $title, $keywords, $description, $css_ex_files, $css_in_files, $js_ex_files, $js_in_files, $tpl_content;
		
		function __construct ( 
		
			$tpl_content, $title = 'html simple', $keywords = 'html, simple', $description = 'html simple generated'
			, $css_ex_files = null
			, $css_in_files = null
			, $js_ex_files = null
			, $js_in_files = null
			, $js_scripts = null
		) {

			$this -> tpl_content = $tpl_content;
			$this -> title = $title;
			$this -> keywords = $keywords;
			$this -> description = $description;
			
			if ( is_null ( $css_ex_files ) ) $this -> css_ex_files = new storage();
			
			else $this -> css_ex_files = $css_ex_files;

			if ( is_null ( $css_in_files ) ) $this -> css_in_files = new storage();
			
			else $this -> css_in_files = $css_ex_files;
			
			if ( is_null ( $js_ex_files ) ) $this -> js_ex_files = new storage();
			
			else $this -> js_ex_files = $js_ex_files;

			if ( is_null ( $js_in_files ) ) $this -> js_in_files = new storage();
			
			else $this -> js_in_files = $css_ex_files;

			if ( is_null ( $js_scripts ) ) $this -> js_scripts = new storage();
			
			else $this -> js_scripts = $js_scripts;
		}
	}