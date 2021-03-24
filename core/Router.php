<?php

	class Router
	{
		static function parse($url, $request)
		{
			$params = [];

			$url = trim($url, '/');
			$params = explode('/', $url);
			$request->controller = $params[0];
			$request->action = isset($params[1]) ? $params[1] : 'index';
			$request->params = array_slice($params, 2);
		}
	}
?>