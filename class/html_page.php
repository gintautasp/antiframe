<?php
	
	class html_page extends response {
	
		public $content;
			
		function __construct() {
		
			parent::__construct();
			
			$this->params->flag_to_statistic = true;			
		
			$this->content = new stdClass;

			$this->content->tpl = 'home.html.php';
			$this->content->title = 'Main page based on minstart framework version 0.0.1';
			$this->content->description = 'Main page based on minstart framework version 0.0.1';
			$this->content->keywords = 'html, page, minstart, framework';
			
			$this->links = new storage();

			$this->files_css = new storage();
			$this->files_js = new storage();
			$this->files_js_jqdr = new storage();
		}
		
		public function set_seo_tkd ( $title, $keywords, $description ) {
		
			$this->content->title = $title;
			$this->content->keywords = $keywords;
			$this->content->description = $description;
		}
		
		public function add_seo_tkd ( $title, $keywords, $description ) {
		
			$this->content->title .= $title;
			$this->content->keywords .= $keywords;
			$this->content->description .= $description;
		}		
	}