<?php

class Welcome extends Controller
{

	function __construct()
	{
		parent::__construct();
		$this->view->layout = "welcome";
	}

	public function index()
	{
		if(Session::has(USER_ID)){
			Session::destroy(USER_ID);
			Cookie::destroy(USER_ID);
		}
		Polyglot::setPage('welcome');
		$this->view->render('welcome/index');
	}

	public function activateUser($verificationCodeArray = null)
	{
		$user_id = isset($verificationCodeArray) ? User::_activateUser($verificationCodeArray[0]) : null;
		Session::set(USER_ID, $user_id);
		isset($user_id) ? $this->redirect('main') : $this->error();
	}

	public function setNewPassword($verificationCodeArray = [])
	{
		$verificationCode = $verificationCodeArray[0];
	}

	/* 	public function test(){
		$tests = $this->user->getTests();
		echo '<pre>';
		var_dump($tests);
	} */


	public function test()
   {
      //print_r(Others::get());
      //echo Helper::copyUploadedImage('532175f5ce18f559b0.png');
      // $test_cards = _Test::getMyHistory(4, 0, 10);
      echo "<pre>";
      // print_r(Mail::setFeedback(4, "salam men erkin"));
      print_r(Question::insertQuestion(['testId' => 54, 'question' => '', 'qFileName' =>'', 'questionData' => '', 'answers' => '', 'questionType' => '',	'isRandom' => 1,	'hasImage' => '', 'order' => 1,	 ]));
   }
}
