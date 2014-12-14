<?php

class IndexController extends Controller {

	public function __construct() {
		parent::__construct();
	}
	/**
	*
	*/
	public function getIndex() {
		return View::make('index');
	}
}
}
