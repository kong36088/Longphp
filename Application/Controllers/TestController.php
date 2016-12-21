<?php

/**
 * Longphp
 * Author: William Jiang
 */

namespace Controllers;

use Long\Input\Input;
use Long\Log\Log;
use Long\Long_Controller;
use Long\Long_Exception;
use Long\Url\Url;

class TestController extends Long_Controller
{

	public function __construct()
	{
		ob_start();
		parent::__construct();
		$this->testConfig();
		$this->testRender();
		$this->testUrl();
		//$this->testError();
		//$this->testException();
		ob_end_flush();
	}
	public function index(){
		echo Input::get('a');
		echo 'this is index method';
	}

	public function testRender()
	{
		$this->render('test', ['test' => 'test here']);
	}

	public function testConfig()
	{
		print_r(\Long\Config\Config::get());
	}

	public function testOutput()
	{
		$this->output(['testdata1' => 'data1', 'testdata2' => 'data2'], 'json');
		$this->output('raw data test' . PHP_EOL, 'raw');
	}

	public function testUrl()
	{
		$this->output(Url::siteUrl('https') . PHP_EOL, 'raw');
	}

	public function testLog(){
		Log::writeLog('Test Error', 'ERROR');
		Log::writeLog('Test DEBUG', 'DEBUG');
		Log::writeLog('Test INFO', 'INFO');
	}

	public function testError(){
		//测试捕获异常
		new EmptyClass();
	}

	public function testException(){
		//测试Exception
		throw new \Exception('Test  Exception');
	}

	public function testModel(){
		$model = M('test');
		print_r($model->query('SELECT * FROM USER'));
	}
}