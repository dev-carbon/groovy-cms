<?php

class Controller
{
	public	$request;
	public	$layout;
	private	$data;
	private	$rendered;

	function __construct($request)
	{
		$this->data = array();
		$this->layout = 'default.php';
		$this->request = $request;
		$this->rendered = false;
	}

	public function render($view)
	{
		if ($this->rendered)
			return (false);
		extract($this->data);
		if (strpos($view, '/') == 0)
			$view = ROOT.DS.'view'.$view.'.php';
		else
			$view = ROOT.DS.'view'.DS.$this->request->controller.DS.$view.'.php';
		ob_start();
		require($view);
		$content = ob_get_clean();
		require ROOT.DS.'view'.DS.'layout'.DS.$this->layout;
		$this->rendered = true;
	}

	public function set($key, $value = null)
	{
		if (is_array($key))
			$this->data += $key;
		else
			$this->data[$key] = $value;
	}
}

?>
