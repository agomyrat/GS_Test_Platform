<?php

class Signup extends Controller
{

	function __construct()
	{
		parent::__construct();
		$this->view->layout = "logo";
	}

	public function index()
	{
		Polyglot::setPage('signup');
		$this->view->render('signup/index');
	}

	public function check_for_input()
	{
		if (isset($_POST)) {
			$column = $_POST['column'];
			$value = $_POST['value'];
			echo User::_has($value, $column);
		}
	}


	public function registrate_user()
	{
		if (!empty($_POST)) {
			$user_id = User::_registrate($_POST); //registrate edilen userin idini return edyar
			$data = User::_get($user_id, ['E_MAIL', 'VERIFY_CODE']);
			$address = $data['E_MAIL'];
			$link = URL . "welcome/activateUser/" . $data['VERIFY_CODE'];
			$address_ = Others::get();
			Polyglot::setPage('registrate_template');
			$this->sendMail($address, [
				'templateName' => 'register',
				'link' => $link,
				'subject' => Polyglot::translate('Registration letter'),
				'welcome' => Polyglot::translate('welcome'),
				'mail_body' => Polyglot::translate('mail_body'),
				'set_active' => Polyglot::translate('set_active'),
				'sended_by_GS' => Polyglot::translate('sended_by_GS'),
				'not_send_mail' => Polyglot::translate('not_send_mail'),
				'address_' => $address_['ADDRESS'] . ' | ' . $address_['TEL']
			]);
			Cookie::set(REGISTRATED, $user_id);
		}
	}
}
