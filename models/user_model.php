<?php 

    class User extends Model{

        public $data = array();

        public function __construct($user_id){
            parent::__construct();
            try{
                $sql = 'SELECT * FROM users WHERE (users.USER_ID = ?) LIMIT 1';
                $query = $this->db->prepare($sql);
                $query->execute([$user_id]);
                if($query->rowCount() > 0){
                    $this->data = $query->fetch(PDO::FETCH_ASSOC);
                }
            }catch(Exception $e){
                echo $e;
            }
        }

       /**
         * UGRATYAN COLUMN VALUE GETIRIP BERYAR 
         * 
         * @param string $column Column name
         * @author Agamyrat C.
         * 
         */
        public function get($column){ //mana array berilyar
            try{
                return $this->data[$column];
            }catch(Exception $e){
                echo $e;
            }
            return false;
        }
        /**
         * ULANYJY ADY VE FAMILYASY
         * 
         * @author Agamyrat C.
         * 
         */
        public function getFullName(){
            try{
                return $this->data['FIRST_NAME']." ".$this->data['SURNAME'];
            }catch(Exception $e){
                echo $e;
            }
            return false;
        }

        /**
         * public bolmaly maglumatlary alyar
         * 
         * @author Agamyrat C.
         * 
         */
        public function getPublicDatas(){
            try{
                $data_ = array();
                foreach ($this->data as $key => $value){
                    if(array_key_exists($key.'_A',$this->data)){
                        if($this->data[$key.'_A'] == 1){
                            $data_[$key] = $value;
                        }
                    }
                }
                return $data_;
            }catch(Exception $e){
                echo $e;
            }
            return false;
        }

        /**
         * UGRATYAN COLUMN VALUE GETIRIP BERYAR 
         * 
         * @param string $column Column name
         * @param str_or_int $new_value Uytgediljek value
         * @author Agamyrat C.
         * 
         */
        public function set($column, $new_value){
            try{
                if (array_key_exists($column,$this->data)){
                    $this->data[$column] = $new_value;
                    return $this;
                }
            }catch(Exception $e){
                echo $e;
            }
            return false;
        }

        /**
         * DB YAZDYRMALY 
         * 
         */
        public function writeDB(){
            try{
                $sql = 'UPDATE users SET ';
                $arr = array();
                foreach ($this->data as $key => $value){
                    $sql .=  'users.'.htmlspecialchars($key).' = ?, ';
                    $arr[] = $value;
                }
                $arr[] = $this->data['USER_ID'];
                $sql = substr($sql, 0, -2). ' WHERE (users.USER_ID = ?) LIMIT 1';
                $query = $this->db->prepare($sql);
                $query->execute($arr);
                if($query->rowCount() > 0){
                    return true;
                }
            }catch(Exception $e){
                echo $e;
            }
            return false;
        }

       
        /**
         * SELECT USER_ID WHERE $column = $value 
         * 
         * @param string $column Column name
         * @param string $value Deňeşdiriljek maglumat
         * @return int User ID
         * @author Agamyrat C.
         * 
         */
        public static function _getUserId($column, $value){
            try{
                $sql = 'SELECT USER_ID FROM users WHERE ('.htmlspecialchars($column).' = ?) LIMIT 1';
                $query = self::$_db_->prepare($sql);
                $query->execute([$value]);
                if($query->rowCount() > 0){
                    return $query->fetch()[0];
                }
            }catch(Exception $e){
                echo $e;
            }
            return false;
        } 

       

        /**
         * SELECT [$columns] WHERE USER_ID = $user_id 
         * 
         * @param int $user_id user_id
         * @param array $columns DB columns name
         * @return array_associative ['column'=>'value','column'=>'value' ...] 
         * @author Agamyrat C.
         * 
         */
        public static function _get($user_id, $columns){
            try{
                $ar_as = array();
                $sql = 'SELECT '.htmlspecialchars(implode(', ',$columns)).' FROM users WHERE (users.USER_ID = ?) LIMIT 1';
                $query = self::$_db_->prepare($sql);
                $query->execute([$user_id]);
                if($query->rowCount() > 0){
                    $data = $query->fetch();
                    $column_count = count($columns);
                    for($i = 0; $i < $column_count; $i++){
                        $ar_as[$query->getColumnMeta($i)['name']] = $data[$i];
                    }
                    return $ar_as;           
                }
            }catch(Exception $e){
                echo $e;
            }
            return false;

        }

        public function getVarableNameWithColumnName($columnName){
            $da = array('USER_ID'=>'userId', 'FIRST_NAME'=>'firstName', 'SURNAME'=>'surname', 'E_MAIL'=>'email', 'USER_NAME'=>'userName', 'PASSWORD'=>'password', 'BIRTH_DATE'=>'birthDate', 'PHONE_NUMBER'=>'phoneNumber', 'COUNTRY'=>'country', 'CITY'=>'city', 'ACTIVE'=>'active', 'IMAGE'=>'image', 'GENDER'=>'gender', 'JOB'=>'job', 'BIO'=>'bio', 'STATUS'=>'status', 'VERIFY_CODE'=>'verifyCode', 'CREATE_TIME'=>'createTime', 'ISADMIN'=>'isAdmin', 'EMAIL_SUBSCRIBE'=>'email_subscribe', 'GMT'=>'gmt', 'LANGUAGE'=>'language');
            return $da[$columnName];
            
        }
        /**
         * public bolmaly maglumatlary alyar
         * 
         * @author Agamyrat C.
         * 
         */
        public static function _getPublicDatas($id){
            try{
                $sql = 'SELECT * FROM users WHERE (users.USER_ID = ?) LIMIT 1';
                $query = self::$_db_->prepare($sql);
                $query->execute([$id]);
                if($query->rowCount() > 0){
                    $data = $query->fetch(PDO::FETCH_ASSOC);
                    $data_ = array();
                    foreach ($data as $key => $value){
                        if(array_key_exists($key.'_A',$data)){
                            if($data[$key.'_A'] == 1){
                                $data_[self::getVarableNameWithColumnName($key)] = $value;
                            }
                        }
                    }

                    return  $data_;
                }
                return false;
            }catch(Exception $e){
                echo $e;
            }
            return false;
        }

        /**
         * USERYN DOLY ADY FAMILYASY GELYAR
         * 
         * @param int $user_id User ID-sy
         * @return string Ady Familyasy
         * @author Agamyrat C.
         * 
         */
        public static function _getFullName($user_id){
            try{
                $sql = 'SELECT FIRST_NAME, SURNAME FROM users WHERE (users.USER_ID = ?) LIMIT 1';
                $query = self::$_db_->prepare($sql);
                $query->execute([$user_id]);
                $data = $query->fetch();
                if($query->rowCount() > 0){
                    return $data[0].' '.$data[1];
                }
            }catch(Exception $e){
                echo $e;
            }
            return false;
            
        }


        /**
         * UPDATE users SET $column = $new_value WHERE USER_ID = $user_id
         * 
         * @param int $user_id User ID-sy
         * @param string $column User ID-sy
         * @param string $new_value User ID-sy
         * @return bool true or false
         * @author Agamyrat C.
         * 
         */
        public static function _set($user_id, $column, $new_value){
            try{
                $sql = 'UPDATE users SET  '.htmlspecialchars($column).' = :new_value WHERE (users.USER_ID = :user_id) LIMIT 1';
                $query = self::$_db_->prepare($sql);
                $query->bindParam(':new_value',$new_value, PDO::PARAM_STR);
                $query->bindParam(':user_id',$user_id, PDO::PARAM_INT);
                $query->execute();
                if($query->rowCount() > 0){
                    return true;
                }
            }catch(Exception $e){
                echo $e;
            }
            return false;
        }

        /**
         * UPDATE users SET $associative WHERE USER_ID = $user_id 
         * 
         * @param int $user_id Column name
         * @param array_associative $associative ['column'=>'value','column'=>'value' ...]
         * @return bool true or false
         * @author Agamyrat C.
         * 
         */
        public static function _setPublicDatas($user_id, $associative){
            try{
                $sql = 'UPDATE users SET ';
                $arr = array();
                foreach ($associative as $key => $value){
                    $sql .=  'users.'.htmlspecialchars($key).' = ?, ';
                    $arr[] = $value;
                }
                $arr[] = $user_id;
                $sql = substr($sql, 0, -2). ' WHERE (users.USER_ID = ?) LIMIT 1';
                $query = self::$_db_->prepare($sql);
                $query->execute($arr);
                if($query->rowCount() > 0){
                    return true;
                }
            }catch(Exception $e){
                echo $e;
            }
            return false;
        }



        // on edilenler
        public static function _registrate($array=null){
			$firstname = $array['user']['firstname'];
			$lastname = $array['user']['lastname'];
			$username = $array['user']['username'];
			$country = $array['user']['country'];
			$phoneNumber = $array['user']['phoneNumber'];
			$birthDate = $array['user']['birthDate'];//duzetmeli (int-int-int) formada gechirmeli
			$email = $array['user']['email'];
			$password = md5($array['user']['password']);
			
			try{
				$sql="INSERT INTO `test_platform`.`users`(`FIRST_NAME`, `SURNAME`, `E_MAIL`, `USER_NAME`, `PHONE_NUMBER`, `COUNTRY`,`ACTIVE`,`PASSWORD`,`VERIFY_CODE`)"
				." VALUES (:firstname, :lastname, :email, :username, :phoneNumber, :country, 0, :password, UUID());";
				$query = self::$_db_->prepare($sql);
				$query->execute([
					':firstname'=>$firstname,
					':lastname'=>$lastname,
					':email'=>$email,
					':username'=>$username,
					//':birthDate'=>$birthDate,
					':phoneNumber'=>$phoneNumber,
					':country'=>$country,
					':password'=>$password]);
				    
                    return self::$_db_->lastInsertId();


			}catch(PDOException $e) {
                  echo $sql . "<br>" . $e->getMessage();
                  return false;
			}
        }

        public static function _activateUser($verifyCode){
             $update_sql = "UPDATE users SET ACTIVE = 1 WHERE (VERIFY_CODE = ?) LIMIT 1";
             $update_stmt = self::$_db_->prepare($update_sql);

             $select_sql = 'SELECT USER_ID FROM users WHERE (VERIFY_CODE = ?) LIMIT 1';
             $select_query = self::$_db_->prepare($select_sql);

             $update_stmt->execute([$verifyCode]);
             $select_query->execute([$verifyCode]);

             return $select_query->fetch()[0];//eger user_id tapylmasa boljak zatlary pikirlenmeli
        }

        public static function _has($value,$column){
            $sql = "SELECT COUNT(*) FROM users WHERE $column = ?";
            $query =self::$_db_->prepare($sql);
            $query->execute([$value]);
            return (bool) $query->fetch()[0];
        }

         public static function _isActive($user_id){
            $sql = "SELECT ACTIVE FROM users WHERE USER_ID = ?";
            $query = self::$_db_->prepare($sql);
            $query->execute([$user_id]);
            return (bool) $query->fetch()[0];
        }

        public function getTests(){
            $testObjectsArray = [];
            $testsArray = $this->hasMany('users_tests',['USER_ID'=>'TEST_ID'],$this->data['USER_ID']);
            foreach ($testsArray as $test){
                array_push($testObjectsArray, new Test($test['TEST_ID']));
            }
            return $testObjectsArray;

        }
    }
?>