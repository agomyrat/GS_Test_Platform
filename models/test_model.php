<?php 

    class Test extends Model{

        
        public $data = array();

        public function __construct($test_id){
            parent::__construct();
            try{
                $sql = 'SELECT * FROM tests WHERE (tests.TEST_ID = ?) LIMIT 1';
                $query = $this->db->prepare($sql);
                $query->execute([$test_id]);
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
         * tazeden seretmeli yalmyshlyk bolup biler
         */
        public function writeDB(){
            try{
                $sql = 'UPDATE tests SET ';
                $arr = array();
                foreach ($this->data as $key => $value){
                    $sql .=  'tests.'.htmlspecialchars($key).' = ?, ';
                    $arr[] = $value;
                }
                $arr[] = $this->data['TEST_ID'];
                $sql = substr($sql, 0, -2). ' WHERE (tests.TEST_ID = ?) LIMIT 1';
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
        public static function _getTestId($column, $value){
            try{
                $sql = 'SELECT TEST_ID FROM tests WHERE ('.htmlspecialchars($column).' = ?) LIMIT 1';
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
         * duzetmeli bolup biler!
         */
         
        public static function _get($test_id, $columns){
            try{
                $ar_as = array();
                $sql = 'SELECT '.htmlspecialchars(implode(', ',$columns)).' FROM tests WHERE (tests.TEST_ID = ?) LIMIT 1';
                $query = self::$_db_->prepare($sql);
                $query->execute([$test_id]);
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

        /**
         * UPDATE tests SET $column = $new_value WHERE TEST_ID = $user_id
         * 
         * @param int $user_id User ID-sy
         * @param string $column User ID-sy
         * @param string $new_value User ID-sy
         * @return bool true or false
         * @author Agamyrat C.
         * 
         */
        public static function _set($test_id, $column, $new_value){
            try{
                $sql = 'UPDATE users SET  '.htmlspecialchars($column).' = :new_value WHERE (tests.TEST_ID = :test_id) LIMIT 1';
                $query = self::$_db_->prepare($sql);
                $query->bindParam(':new_value',$new_value, PDO::PARAM_STR);
                $query->bindParam(':user_id',$test_id, PDO::PARAM_INT);
                $query->execute();
                if($query->rowCount() > 0){
                    return true;
                }
            }catch(Exception $e){
                echo $e;
            }
            return false;
        }

        public static function _has($value,$column){
            $sql = "SELECT COUNT(*) FROM tests WHERE $column = ?";
            $query =self::$_db_->prepare($sql);
            $query->execute([$value]);
            return (bool) $query->fetch()[0];
        }

         public static function _isAllowed($test_id){
            $sql = "SELECT ACTIVE FROM tests WHERE TEST_ID = ?";
            $query = self::$_db_->prepare($sql);
            $query->execute([$test_id]);
            return (bool) $query->fetch()[0];
        }

        public function createTest($test_name){
          //  'create test' buttona basan wagty islemeli funksiya. Testin ady, doredilen wagty soralmaly
          //   Testin adyny insert edip testin id-sini return etmeli. 
          return $test_id;
        }

        public function deleteTest($test_id){
            //hachan-da user testi pozmak islan wagty
            //parameter hokmunde testin id-sini almaly
            return true; //eger ustunlikli bolsa
        }

        public function getUser(){
            $user_id = $this->hasOne('users_tests', ['TEST_ID'=>'USER_ID'], $this->data['TEST_ID']);
            return new User($user_id);
        }

        public static function _getUser($test_id){

            //bu funksiyany ozum yazarn
            //return object;
        }

        public function getQuestions(){
            //return array of objects
        }

        public static function _getPopularTests(){
            //return array of objects  e.g. ['test_id'=>object] //sanyny ozuniz kesgitlan belki 5 object belki 4
        }

        public static function _getRecentTests(){
            //return array of objects  e.g. ['test_id'=>object] //sanyny ozuniz kesgitlan belki 5 object belki 4
        }

        public function increment(/*VIEWS, LIKES*/){
            //berlen columndaky sana 1 goshmaly
        }


    }
?>