<?php
	/**
	 * Dispatcher
	 */
	class Dispatcher
	{
		public $request;
		
		function __construct()
		{
			$this->request = new Request();
			Router::parse($this->request->url, $this->request);
			$controller = $this->loadController();
			if (!in_array($this->request->action, get_class_methods($controller)))
			{
				$this->error('Le controlleur '.$this->request->controller.' n\'a pas de méthode '.$this->request->action);
			}
			call_user_func_array(array($controller, $this->request->action), $this->request->params);
			$controller->render($this->request->action);
		}

		public function error($message)
		{
			header("HTTP/1.0 404 Not Found");
			$controller = new Controller($this->request);
			$controller->set('message', $message);
			$controller->render('/errors/404');
			exit();
		}

		public function loadController()
		{
			$controller = ucfirst($this->request->controller);
			require ROOT.DS.'controller'.DS.$controller.'.php';
			return new $controller($this->request);
		}
	}
?>