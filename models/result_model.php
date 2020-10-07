<?php 

    class Result extends Model{
        public static function getID($test_id, $user_id)
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
                return $query->fetch()[0];
            } catch (Exception $e) {
                echo $e;
            }
        }

        public static function hasID($test_id, $user_id)
        {
            $db = new Database;
            try {
                $sql = 'SELECT 
                            COUNT(*)
                        FROM 
                        result 
                        WHERE USER_ID = :user_id AND TEST_ID = :test_id';
                $query = $db->prepare($sql);
                $query->execute([
                    ":test_id" => $test_id,
                    ":user_id" => $user_id
                ]);
                return $query->fetch()[0];
            } catch (Exception $e) {
                echo $e;
            }
        }

        public static function insertRow($test_id, $user_id)
        {
            $db = new Database;
            try {
                $sql = 'INSERT INTO result(TEST_ID,USER_ID) VALUES (:test_id,:user_id)';
                $query = $db->prepare($sql);
                $query->execute([
                    ":test_id" => $test_id,
                    ":user_id" => $user_id
                ]);
            } catch (Exception $e) {
                echo $e;
            }
            return $db->lastInsertId();
        }

        public static function has($value, $column)
        {
            $db = new Database;
            $sql = "SELECT COUNT(*) FROM result WHERE $column = ?";
            $query = $db->prepare($sql);
            $query->execute([$value]);
            return (bool) $query->fetch()[0];
        }
    }
?>