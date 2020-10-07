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
            /* echo 'post';
            print_r(($_POST));
            echo 'files';
            print_r($_FILES);
            die; */
            $firstName = $_POST['firstname']['value'];
            $surname = $_POST['surname']['value'];
            $username = $_POST['username']['value'];
            $tel = $_POST['tel']['value'];
            $gender = (int) $_POST['gender']['value'];
            $country = $_POST['country']['value'];
            $city = $_POST['city']['value'];
            $lang = $_POST['lang']['value'];
            $birthDate = $_POST['birthDate']['value'];
            $status = (int) $_POST['status']['value'];
            $job = $_POST['job']['value'];
            $time = $_POST['time']['value'];
            $bio = $_POST['bio']['value'];

            $firstName_a = $_POST['firstname']['isGlobal'];
            $surname_a = $_POST['surname']['isGlobal'];
            $username_a = $_POST['username']['isGlobal'];
            $tel_a = $_POST['tel']['isGlobal'];
            $gender_a =  $_POST['gender']['isGlobal'];
            $country_a = $_POST['country']['isGlobal'];
            $city_a = $_POST['city']['isGlobal'];
            $lang_a = $_POST['lang']['isGlobal'];
            $birthDate_a = $_POST['birthDate']['isGlobal'];
            $status_a = $_POST['status']['isGlobal'];
            $job_a = $_POST['job']['isGlobal'];
            $time_a = $_POST['time']['isGlobal'];
            $bio_a = $_POST['bio']['isGlobal'];
            echo $bio_a;
            //echo $gender;die;
            echo "has something ";
            $bool = User::_setPublicDatas(Session::get(USER_ID),[
                'FIRST_NAME'=>$firstName,
                'SURNAME'=>$surname,
                'USER_NAME'=>$username,
                'PHONE_NUMBER'=>$tel,
                'GENDER'=>$gender,
                'COUNTRY'=> $country,
                'CITY'=>$city,
                'LANGUAGE'=>$lang,
                'BIRTH_DATE'=>$birthDate,
                'STATUS'=>$status,
                'JOB'=>$job,
                'GMT'=>$time,
                'BIO'=>$bio,

                'FIRST_NAME_A'=>$firstName_a,
                'SURNAME_A'=>$surname_a,
                'USER_NAME_A'=>$username_a,
                'PHONE_NUMBER_A'=>$tel_a,
                'GENDER_A'=>$gender_a,
                'COUNTRY_A'=> $country_a,
                'CITY_A'=>$city_a,
                //'LANGUAGE_A'=>$lang_a,
                'BIRTH_DATE_A'=>$birthDate_a,
                //'STATUS_A'=>$status_a,
                'JOB_A'=>$job_a,
                //'GMT_A'=>$time_a,
                'BIO_A'=>$bio_a,
            ]);

            if($bool){
                echo "cooool";
            }
        }
    }




?>