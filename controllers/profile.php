<?php 

    class Profile extends Controller{
        public function __construct(){
            parent::__construct();
            $this->view->layout = 'main';
        }

        public function index(){
            Polyglot::setPage('main');
            Polyglot::extendPage('navbar');
            $this->view->render('profile/index',['user'=>$this->user]);
        }

        public function myProfile(){
            // echo 'post';
            // print_r(($_POST));
            // echo 'files';
            // print_r($_FILES);
            // $globals = json_decode($_POST['inputs']);
            // print_r($globals);
            // die;
            $firstName = isset($_POST['firstname']) ? $_POST['firstname'] : '';
            $surname = isset($_POST['surname']) ? $_POST['surname'] : '';
            $username = isset($_POST['username']) ? $_POST['username'] : '';
            $tel = isset($_POST['tel']) ? $_POST['tel'] : '';
            $gender = isset($_POST['gender']) ? (int) $_POST['gender'] : '';
            $country = isset($_POST['country']) ? $_POST['country'] : '';
            $city = isset($_POST['city']) ? $_POST['city'] : '';
            $lang = isset($_POST['lang']) ? $_POST['lang'] : 'TM';
            $birthDate = isset($_POST['birthDate']) ? $_POST['birthDate'] : null;
            $status = isset($_POST['status']) ? (int) $_POST['status'] : 2;
            $job = isset($_POST['job']) ? $_POST['job'] : '';
            $time = isset($_POST['time']) ? $_POST['time'] : '';
            $bio = isset($_POST['bio']) ? $_POST['bio'] : '';
            $oldImage = isset($_POST['oldImage']) ? $_POST['oldImage'] : 'profile.png';
            $image_name = isset($_FILES['img']) ?  : 'profile.png';
            if(!empty($_FILES['img']['name'])){
                $image_name = Helper::uploadImage($_FILES['img']);
                $oldImage != 'profile.png' ? Helper::deleteFiles($oldImage): null;
            }else{
                $image_name = $oldImage;
            }

            $globals = json_decode($_POST['inputs']);

            $firstName_a = $globals->firstname->isGlobal;
            $surname_a = $globals->surname->isGlobal;
            $username_a = $globals->username->isGlobal;
            $tel_a = $globals->tel->isGlobal;
            $gender_a =  $globals->gender->isGlobal;
            $country_a = $globals->country->isGlobal;
            $city_a = $globals->city->isGlobal;
            $lang_a = $globals->lang->isGlobal;
            $birthDate_a = $globals->birthDate->isGlobal;
            $status_a = $globals->status->isGlobal;
            $job_a = $globals->job->isGlobal;
            //$time_a = $globals->time->isGlobal;
            //$bio_a = $globals->bio->isGlobal;

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
                'IMAGE'=>$image_name,

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
                //'BIO_A'=>$bio_a,
            ]);

            if($bool){
                echo $image_name;
            }
        }
    }




?>