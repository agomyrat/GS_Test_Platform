<?php 

    class Profile extends Controller{
        public function __construct(){
            parent::__construct();
            $this->view->layout = 'main';
        }

        public function index(){
            Polyglot::setPage('profile');
            $this->view->render('profile/index',['user'=>$this->user]);
        }

        public function myProfile(){
            echo 'post';
            print_r($_POST);
            echo 'files';
            print_r($_FILES);
            $firstName = $_POST['firstname'];
            $surname = $_POST['surname'];
            $username = $_POST['username'];
            $tel = $_POST['tel'];
            $gender = $_POST['gender'];
            $country = $_POST['country'];
            $city = $_POST['city'];
            $lang = $_POST['lang'];
            $birthDate = $_POST['birthDate'];
            $status = $_POST['status'];
            $job = $_POST['job'];
            $time = $_POST['time'];
            $bio = $_POST['bio'];

            $bool = User::setPublicDatas(Session::get(USER_ID),[
                'FIRST_NAME'=>$firstName,
                'SURNAME'=>$surname,
                'USER_NAME'=>$username,
                'PHONE_NUMBER'=>$tel,
                'COUNTRY'=> $country,
                'CITY'=>$city,
                'LANGUAGE'=>$lang,
                'BIRTH_DATE'=>$birthDate,
                'STATUS'=>$status,
                'JOB'=>$job,
                'GMT'=>$time,
                'BIO'=>$bio
            ]);

            if($bool){
                $this->redirect('main');
            }
        }
    }




?>