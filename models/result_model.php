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

        public static function hasResult($user_id, $test_id)
        {
            $db = new Database;
            $sql = "SELECT COUNT(*) FROM result WHERE USER_ID = ? AND TEST_ID = ?";
            $query = $db->prepare($sql);
            $query->execute([$user_id,$test_id]);
            return (bool) $query->fetch()[0];
        }

        /**
         * 
         * Ahli ballar (resault table)
         * ADY_FAMILYASY | @USER_NAME | DOGRY_JOGAPSANY | NADOGRY_JOGAP_SANY | COZULMEDIK_SORAG_SANY | WAGT
         *
         * @param int $test_id Test_id
         * @param int $order_by_column (USER_FULL_NAME, USER_NAME, TRUE_ANSWER_COUNT, FALSE_ANSWER_COUNT, NOT_SOLVED, TIME_SOLVING)
         * @param int $order_by_type desc, asc
         * @author Agamyrat C
         *
         */
        public static function resultTable($test_id, $order_by_column = 'SCORE', $order_by_type = 'DESC')
        {
            $db = new Database;
            try {
                $ORDER_BY_SQL = ' ORDER BY  ';
                switch ($order_by_column) {
                    case 'USER_FULL_NAME':
                        $ORDER_BY_SQL .= 'CONCAT(users.FIRST_NAME,\' \',	users.SURNAME)';
                        break;
                    case 'USER_NAME':
                        $ORDER_BY_SQL .= 'users.USER_NAME';
                        break;
                    case 'TRUE_ANSWER_COUNT':
                        $ORDER_BY_SQL .= 'TRUE_ANSWER_COUNT';
                        break;
                    case 'FALSE_ANSWER_COUNT':
                        $ORDER_BY_SQL .= '( COUNT( solving.SOLVING_ID ) - result.TRUE_ANSWER_COUNT )';
                        break;
                    case 'NOT_SOLVED':
                        $ORDER_BY_SQL .= 'result.QUESTION_COUNT - COUNT( solving.SOLVING_ID )';
                        break;
                    case 'TIME_SOLVING':
                        $ORDER_BY_SQL .= 'CASE WHEN ISNULL(result.END_TIME) THEN tests.GIVEN_TIME * 60  ELSE TIMESTAMPDIFF(second,result.START_TIME,result.END_TIME) END';
                        break;
                    case 'SCORE':
                        $ORDER_BY_SQL .= 'result.SCORE';
                        break;
                }
                $sql = "SELECT
                            users.USER_ID,
                            CONCAT(users.FIRST_NAME,' ',	users.SURNAME) USER_FULL_NAME,
                            CONCAT('@',users.USER_NAME) as USER_NAME,
                            result.TRUE_ANSWER_COUNT,
                            ( COUNT( solving.SOLVING_ID ) - result.TRUE_ANSWER_COUNT ) FALSE_ANSWER_COUNT,
                            result.QUESTION_COUNT - COUNT( solving.SOLVING_ID ) NOT_SOLVED,
                            result.SCORE,
                            CASE WHEN ISNULL(result.END_TIME)*60 THEN tests.GIVEN_TIME * 60 ELSE TIMESTAMPDIFF(second,result.START_TIME,result.END_TIME) END TIME_SOLVING
                        FROM
                            result
                            LEFT JOIN users ON users.USER_ID = result.USER_ID
                            LEFT JOIN tests ON tests.TEST_ID = result.TEST_ID
                            LEFT JOIN solving ON solving.RESULT_ID = result.RESULT_ID 
                        WHERE
                            result.TEST_ID = ?
                        GROUP BY
                            users.USER_ID,
                            CONCAT(users.FIRST_NAME,' ',	users.SURNAME),
                            users.USER_NAME,
                            result.START_TIME,
                            result.END_TIME,
                            result.SCORE,
                            result.TRUE_ANSWER_COUNT,
                            result.QUESTION_COUNT 

                            $ORDER_BY_SQL $order_by_type";
                // echo $sql;
                $query = $db->prepare($sql);
                $query->execute([$test_id]);
                $returnDatasALL = [];
                while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                    $second = $row->TIME_SOLVING;
                    $second_text = (int)($second/60).':'.(($second%60) < 10 ? '0'.($second%60) : ($second%60));
                    echo $second_text;
                    echo '<br>';
                    $returnDatas = null;
                    $returnDatas["USER_FULL_NAME"] = $row->USER_FULL_NAME;
                    $returnDatas["USER_NAME"] = $row->USER_NAME;
                    $returnDatas["TRUE_ANSWER_COUNT"] = $row->TRUE_ANSWER_COUNT;
                    $returnDatas["FALSE_ANSWER_COUNT"] = $row->FALSE_ANSWER_COUNT;
                    $returnDatas["NOT_SOLVED"] = $row->NOT_SOLVED;
                    $returnDatas["SCORE"] = $row->SCORE;
                    $returnDatas["TIME_SOLVING"] = $second_text;
                    $returnDatasALL[] = $returnDatas;
                }
                return $returnDatasALL;
            } catch (Exception $e) {
                var_dump($e);
            }
        }


        /**
         * 
         * QUESTION BAZYNDA RAPOR 
         * 
         * @param int $test_id Test_id
         * @author Agamyrat C
         *
         */
        public static function questionChart($test_id)
        {
            $db = new Database;
            try {

                $sql = "SELECT
                            questions.QUESTION_ORDER,
                            questions.QUESTION,
                            SUM( CASE WHEN solving.TRUE_FALSE = 1 THEN 1 ELSE 0 END ) TRUE_ANSWER_COUNT,
                            COUNT( solving.SOLVING_ID ) - SUM( CASE WHEN solving.TRUE_FALSE = 1 THEN 1 ELSE 0 END ) FALSE_ANSWER_COUNT,
                            tests.SOLVING_COUNT - COUNT( solving.SOLVING_ID ) NOT_SOLVED 
                        FROM
                            questions
                            LEFT JOIN tests ON tests.TEST_ID = questions.TEST_ID
                            LEFT JOIN solving ON questions.QUESTIONS_ID = solving.QUESTION_ID 
                        WHERE
                            questions.TEST_ID = ?
                        GROUP BY
                            questions.QUESTION_ORDER,
                            questions.QUESTION
                        ORDER BY questions.QUESTION_ORDER
                            ";
                // echo $sql;
                $query = $db->prepare($sql);
                $query->execute([$test_id]);
                $returnDatasALL = [];
                while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                    // echo 'sdfsdf';
                    $returnDatas = null;
                    $returnDatas["QUESTION_ORDER"] = $row->QUESTION_ORDER;
                    $returnDatas["QUESTION"] = $row->QUESTION;
                    $returnDatas["TRUE_ANSWER_COUNT"] = $row->TRUE_ANSWER_COUNT;
                    $returnDatas["FALSE_ANSWER_COUNT"] = $row->FALSE_ANSWER_COUNT;
                    $returnDatas["NOT_SOLVED"] = $row->NOT_SOLVED;
                    $returnDatasALL[] = $returnDatas;
                }
                return $returnDatasALL;
            } catch (Exception $e) {
                var_dump($e);
            }
        }



        /**
         * 
         * PAYCHART
         * 
         * @param int $test_id Test_id
         * @author Agamyrat C
         *
         */
        public static function payChart($test_id)
        {
            $db = new Database;
            try {

                $sql = "SELECT
                ( AVG( TRUE_ANSWER_COUNT )* 100 ) / AVG( QUESTION_COUNT ) TRUE_ANSWER_AVG,
                ( AVG( WRONG_ANSWER )* 100 ) / AVG( QUESTION_COUNT ) WRONG_ANSWER_AVG,
                ( AVG( NOT_ANSWER_COUNT )* 100 ) / AVG( QUESTION_COUNT ) NOT_ANSWER_AVG 
            FROM
                (
                SELECT
                    result.RESULT_ID,
                    result.QUESTION_COUNT,
                    result.TRUE_ANSWER_COUNT,
                    count( solving.SOLVING_ID ) - result.TRUE_ANSWER_COUNT WRONG_ANSWER,
                    result.QUESTION_COUNT - count( solving.SOLVING_ID ) NOT_ANSWER_COUNT 
                FROM
                    result
                    LEFT JOIN solving ON solving.RESULT_ID = result.RESULT_ID 
                WHERE
                    result.TEST_ID = ?
                GROUP BY
                    result.RESULT_ID,
                    result.TRUE_ANSWER_COUNT,
                    result.QUESTION_COUNT 
                ) ASD
                            ";
                // echo $sql;
                $query = $db->prepare($sql);
                $query->execute([$test_id]);
                $returnDatasALL = [];
                while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                    // echo 'sdfsdf';
                    $returnDatas = null;
                    $returnDatas["True answers"] = (int) $row->TRUE_ANSWER_AVG;
                    $returnDatas["Wrong answers"] = (int) $row->WRONG_ANSWER_AVG;
                    $returnDatas["Not answered"] = (int) $row->NOT_ANSWER_AVG;
                }
                return $returnDatas;
            } catch (Exception $e) {
                var_dump($e);
            }
        }
    }
?>
    
    