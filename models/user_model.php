<?php 
namespace model\user_model;

    class User_model extends Model{

        public $id;

        public function __construct($user_id){
            parent::__construct();

            $this->id = $user_id;
        }

        //bu functionlaryn hemmesini $this->id bilen select etmeli 
        public function getUsername(){
        
        }

        public function getFirstName(){
            return $firstName;
        }

        public function getLastName(){
            return $lastName;
        }

        public function getFullName(){
            return $this->getFirstName()." ".$this->getLastName();
        }

        public function getMail(){
            return $mail;
        }

        public function getPassword(){

        }

        public function getBirthDate(){

        }

        public function getPhoneNumber(){
            
        }

        public function getCountry(){
            
        }

        public function getCity(){
            
        }

        public function getImage(){
            
        }

        public function getGender(){
            //return 'male', 'female', 'others' sheklinde bolmaly
        }

        public function getJob(){
            
        }

        public function getBio(){
            
        }

        public function getStatus(){
           // return 'teacher','student', 'others' sheklinde bolmaly
        }
         
        public function getVerifyCode(){
            
        }

        public function getCreatedTime(){
            
        }

        public function getGMT(){
            
        }

        public function getLanguage(){
            
        } 

        public function getProfileDatas(){
            return [];
        }

        public function getUserType(){
            //return admin/moderator/general sheklinde
        }

        public function getPublicDatas(){
            return [];
        }

        public function isAdmin(){
            
        }

        public function isModerator(){
            
        }

        public function isGeneral(){
            
        }

        public function isActive(){
            
        }

        public function doMailNotify(){

        }

        //static functions

         //columndan user id almaly
        public static function getUserId($column, $value){
            //bellik: gerek bolsa $column uchin config papkada birnache constantlar bellars
        } 

        //bu functionlaryn hemmesini $this->id bilen select etmeli 
        public static function getUsername($user_id){
        
        }

        public static function getFirstName($user_id){
            return $firstName;
        }

        public static function getLastName($user_id){
            return $lastName;
        }

        public static function getFullName($user_id){
            return self::setFirstName($user_id)." ".self::setLastName($user_id);
        }

        public static function getMail($user_id){
            return $mail;
        }

        public static function getPassword($user_id){

        }

        public static function getBirthDate($user_id){

        }

        public static function getPhoneNumber($user_id){
            
        }

        public static function getCountry($user_id){
            
        }

        public static function setCity($user_id){
            
        }

        public static function setImage($user_id){
            
        }

        public static function setGender($user_id){
            //return 'male', 'female', 'others' sheklinde bolmaly
        }

        public static function setJob($user_id){
            
        }

        public static function setBio($user_id){
            
        }

        public static function setStatus($user_id){
           // return 'teacher','student', 'others' sheklinde bolmaly
        }
         
        public static function setVerifyCode($user_id){
            
        }

        public static function setCreatedTime($user_id){
            
        }

        public static function setGMT($user_id){
            
        }

        public static function setLanguage($user_id){
            
        }

        public static function setUserType($user_id){
            //return admin/moderator/general sheklinde
        }

        public function setUsername($value){
        
        }

        public function setFirstName($value){
            return $firstName;
        }

        public function setLastName($value){
            return $lastName;
        }

        public function setFullName($value){
            return $this->setFirstName($value)." ".$this->setLastName($value);
        }

        public function setMail($value){
            return $mail;
        }

        public function setPassword($value){

        }

        public function setBirthDate($value){

        }

        public function setPhoneNumber($value){
            
        }

        public function setCountry($value){
            
        }

        public function setCity($value){
            
        }

        public function setImage($value){
            
        }

        public function setGender($value){
            //return 'male', 'female', 'others' sheklinde bolmaly
        }

        public function setJob($value){
            
        }

        public function setBio($value){
            
        }

        public function setStatus($value){
           // return 'teacher','student', 'others' sheklinde bolmaly
        }
         
        public function setVerifyCode($value){
            
        }

        public function setCreatedTime($value){
            
        }

        public function setGMT($value){
            
        }

        public function setLanguage($value){
            
        }

        public function setUserType($value){
            //return admin/moderator/general sheklinde
        }

        public function isAdmin($value){
            
        }

        public function isModerator($value){
            
        }

        public function isGeneral($value){
            
        }

        public function isActive($value){
            
        }

        public function isPublic($column){
            //return true/false sheklinde bolmaly
        }

        public function doMailNotify($value){

        }

        public static function InsertDatas(){

        }

        User_model::InsertDatas();


        //static functions

  /*       //columndan user id almaly
        public static function setUserId($column, $value){
            //bellik: gerek bolsa $column uchin config papkada birnache constantlar bellars
        } 

        //bu functionlaryn hemmesini $this->id bilen select etmeli 
        public static function setUsername($user_id){
        
        }

        public static function setFirstName($user_id){
            return $firstName;
        }

        public static function setLastName($user_id){
            return $lastName;
        }

        public static function setFullName($user_id){
            return self::setFirstName($user_id)." ".self::setLastName($user_id);
        }

        public static function setMail($user_id){
            return $mail;
        }

        public static function setPassword($user_id){

        }

        public static function setBirthDate($user_id){

        }

        public static function setPhoneNumber($user_id){
            
        }

        public static function setCountry($user_id){
            
        }

        public static function setCity($user_id){
            
        }

        public static function setImage($user_id){
            
        }

        public static function setGender($user_id){
            //return 'male', 'female', 'others' sheklinde bolmaly
        }

        public static function setJob($user_id){
            
        }

        public static function setBio($user_id){
            
        }

        public static function setStatus($user_id){
           // return 'teacher','student', 'others' sheklinde bolmaly
        }
         
        public static function setVerifyCode($user_id){
            
        }

        public static function setCreatedTime($user_id){
            
        }

        public static function setGMT($user_id){
            
        }

        public static function setLanguage($user_id){
            
        }

        public static function setUserType($user_id){
            //return admin/moderator/general sheklinde
        }
*/
        





    }
?>