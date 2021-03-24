<?php
	/**
	 * Request
	 */
	class Request
	{
		public $url;
		public $controller;
		public $action;
		
		function __construct()
		{
			$this->url = $_SERVER['REQUEST_URI'];
		}
	}
?>