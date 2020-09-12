<?php 

    class Result extends Model{
        public static function getResultID($test_id, $user_id)
        {
            $db = new Database;
            try {
                $sql = 'SELECT 
                            RESULT_ID
                        FROM 
                        result 
                        WHERE USER_ID = :user_id AND TEST_ID = :test_id
                        ORDER BY RESULT_ID DESC
                        LIMIT 1;';
                $query = $db->prepare($sql);
                $query->execute([
                    ":test_id" => $test_id,
                    ":user_id" => $user_id
                ]);
                return $query->fetchAll()[0];
            } catch (Exception $e) {
                echo $e;
            }
        }
    }
?>