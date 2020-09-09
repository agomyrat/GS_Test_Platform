<?php

class _Test extends Model
{

    public static function getTestId($column, $value)
    {
        $db = new Database;
        try {
            $sql = 'SELECT TEST_ID FROM tests WHERE (' . htmlspecialchars($column) . ' = ?) LIMIT 1';
            $query = $db->prepare($sql);
            $query->execute([$value]);
            if ($query->rowCount() > 0) {
                return $query->fetch()[0];
            }
        } catch (Exception $e) {
            echo $e;
        }
        return false;
    }

    public static function get($test_id, $columns)
    {
        $db = new Database;
        try {
            $ar_as = array();
            $sql = 'SELECT ' . htmlspecialchars(implode(', ', $columns)) . ' FROM tests WHERE (tests.TEST_ID = ?) LIMIT 1';
            $query = $db->prepare($sql);
            $query->execute([$test_id]);
            if ($query->rowCount() > 0) {
                $data = $query->fetch();
                $column_count = count($columns);
                for ($i = 0; $i < $column_count; $i++) {
                    $ar_as[$query->getColumnMeta($i)['name']] = $data[$i];
                }
                return $ar_as;
            }
        } catch (Exception $e) {
            echo $e;
        }
        return false;
    }

    public static function set($test_id, $column, $new_value)
    {
        $db = new Database;
        try {
            $sql = 'UPDATE tests SET  ' . htmlspecialchars($column) . ' = :new_value WHERE (tests.TEST_ID = :test_id) LIMIT 1';
            $query = $db->prepare($sql);
            $query->bindParam(':new_value', $new_value, PDO::PARAM_STR);
            $query->bindParam(':user_id', $test_id, PDO::PARAM_INT);
            $query->execute();
            if ($query->rowCount() > 0) {
                return true;
            }
        } catch (Exception $e) {
            echo $e;
        }
        return false;
    }

    public static function has($value, $column)
    {
        $db = new Database;
        $sql = "SELECT COUNT(*) FROM tests WHERE $column = ?";
        $query = $db->prepare($sql);
        $query->execute([$value]);
        return (bool) $query->fetch()[0];
    }

    public static function hasQuestion($value, $column)
    {
        $db = new Database;
        $sql = "SELECT COUNT(*) FROM qu WHERE $column = ?";
        $query = $db->prepare($sql);
        $query->execute([$value]);
        return (bool) $query->fetch()[0];
    }

    public static function isAllowed($test_id)
    {
        $db = new Database;
        $sql = "SELECT IS_ALLOWED FROM tests WHERE TEST_ID = ?";
        $query = $db->prepare($sql);
        $query->execute([$test_id]);
        return (bool) $query->fetch()[0];
    }

    public static function isPublic($test_id)
    {
        $db = new Database;
        $sql = "SELECT IS_PUBLIC FROM tests WHERE TEST_ID = ?";
        $query = $db->prepare($sql);
        $query->execute([$test_id]);
        return (bool) $query->fetch()[0];
    }

    public static function createTest($user_id)
    {
        $db = new Database;
        try {
            $sql = "INSERT INTO tests(TEST_NAME,CREATED_BY) VALUES ('NONAME',?);";
            $query = $db->prepare($sql);
            $query->execute([$user_id]);
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
            return false;
        }
        return $db->lastInsertId();
    }

    public static function deleteTest($test_id)
    {
        $db = new Database;
        try {
            $sql = "DELETE FROM tests WHERE TEST_ID = ?";
            $query = $db->prepare($sql);
            $query->execute([$test_id]);
        } catch (Exception $e) {
            echo $sql . "<br>" . $e->getMessage();
            return false;
        }

        return true;
    }

    public static function getUser($test_id)
    {
        $db = new Database;
        $sql = "SELECT CREATED_BY FROM tests WHERE TEST_ID = ?";
        $query = $db->prepare($sql);
        $query->execute([$test_id]);
        return $query->fetch()[0];
    }

    /**
     * Popular sanyna gora order by  
     * 
     * @param int $limit Test sany. Egerde bosh ugratsan hemmesini alyp berya
     * @return array 
     * @author Agamyrat C.
     * 
     */
    public static function getPopularTests($limit = 0)
    {
        try {
            $data_all = [];
            $db = new Database;
            $limit_text = '';
            if ($limit != 0) {
                $limit_text = ' LIMIT ' . $limit;
            }
            $sql = 'SELECT 
                    users.USER_ID, 
                    CONCAT("@",users.USER_NAME) USER_NAME, 
                    tests.TEST_ID, 
                    tests.TEST_NAME, 
                    tests.DESCRIPTION, 
                    LIKE_COUNT, 
                    DISLIKE_COUNT, 
                    SOLVING_COUNT, 
                    DATE_FORMAT(tests.CREATE_TIME,\'%d.%m.%Y\') CREATED_DATE
            FROM tests
            LEFT JOIN users ON users.USER_ID = tests.CREATED_BY
            WHERE tests.IS_PUBLIC = 1 AND tests.IS_ALLOWED = 1
            ORDER BY (LIKE_COUNT - DISLIKE_COUNT) * 2 + SOLVING_COUNT DESC
            ' . $limit_text;
            $query = $db->prepare($sql);
            $query->execute();
            while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                $data = null;
                $data['USER_ID'] = $row->USER_ID;
                $data['USER_NAME'] = $row->USER_NAME;
                $data['TEST_ID'] = $row->TEST_ID;
                $data['TEST_NAME'] = $row->TEST_NAME;
                $data['LIKE_COUNT'] = $row->LIKE_COUNT;
                $data['SOLVING_COUNT'] = $row->SOLVING_COUNT;
                $data['CREATED_DATE'] = $row->CREATED_DATE;
                $data_all[] = $data;
            }
            return $data_all;
        } catch (Exception $e) {
            echo $e;
            return false;
        }
    }

    public static function getRecentTests($limit = 0)
    {
        try {
            $data_all = [];
            $db = new Database;
            $limit_text = '';
            if ($limit != 0) {
                $limit_text = ' LIMIT ' . $limit;
            }
            $sql = 'SELECT 
                    users.USER_ID, 
                    CONCAT("@",users.USER_NAME) USER_NAME, 
                    tests.TEST_ID, 
                    tests.TEST_NAME, 
                    tests.DESCRIPTION, 
                    LIKE_COUNT, 
                    DISLIKE_COUNT, 
                    SOLVING_COUNT, 
                    DATE_FORMAT(tests.LAST_UPDATE_TIME,\'%d.%m.%Y\') CREATED_DATE
            FROM tests
            LEFT JOIN users ON users.USER_ID = tests.CREATED_BY
            WHERE tests.IS_PUBLIC = 1 AND tests.IS_ALLOWED = 1
            ORDER BY LAST_UPDATE_TIME DESC
            ' . $limit_text;
            $query = $db->prepare($sql);
            $query->execute();
            while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                $data = null;
                $data['USER_ID'] = $row->USER_ID;
                $data['USER_NAME'] = $row->USER_NAME;
                $data['TEST_ID'] = $row->TEST_ID;
                $data['TEST_NAME'] = $row->TEST_NAME;
                $data['LIKE_COUNT'] = $row->LIKE_COUNT;
                $data['SOLVING_COUNT'] = $row->SOLVING_COUNT;
                $data['CREATED_DATE'] = $row->CREATED_DATE;
                $data_all[] = $data;
            }
            return $data_all;
        } catch (Exception $e) {
            echo $e;
            return false;
        }
    }

    public static function getMyPinnedTests($limit = 0)
    {
        try {
            $data_all = [];
            $db = new Database;
            $limit_text = '';
            if ($limit != 0) {
                $limit_text = ' LIMIT ' . $limit;
            }
            $sql = 'SELECT 
                        tests.CREATED_BY, 
                        CONCAT("@", users.USER_NAME) USER_NAME,
                        tests.TEST_ID, 
                        tests.TEST_NAME, 
                        tests.DESCRIPTION, 
                        LIKE_COUNT, 
                        DISLIKE_COUNT, 
                        SOLVING_COUNT, 
                        DATE_FORMAT(pinned_test.CREATE_TIME,\'%d.%m.%Y\') CREATED_DATE
           FROM pinned_test
           LEFT JOIN tests on tests.TEST_ID = pinned_test.TEST_ID
           LEFT JOIN users ON tests.CREATED_BY = users.USER_ID
           WHERE pinned_test.USER_ID = 1
           ORDER BY pinned_test.CREATE_TIME DESC
            ' . $limit_text;
            $query = $db->prepare($sql);
            $query->execute();
            while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                $data = null;
                $data['USER_ID'] = $row->CREATED_BY;
                $data['USER_NAME'] = $row->USER_NAME;
                $data['TEST_ID'] = $row->TEST_ID;
                $data['TEST_NAME'] = $row->TEST_NAME;
                $data['LIKE_COUNT'] = $row->LIKE_COUNT;
                $data['SOLVING_COUNT'] = $row->SOLVING_COUNT;
                $data['CREATED_DATE'] = $row->CREATED_DATE;
                $data_all[] = $data;
            }
            return $data_all;
        } catch (Exception $e) {
            echo $e;
            return false;
        }
    }
    public function increment(/*VIEWS, LIKES*/)
    {
        //berlen columndaky sana 1 goshmaly
    }

    public static function getQuestions($test_id)
    {
        $db = new Database;
        try {
            $response_array = [];
            $sql = "SELECT * FROM questions WHERE (TEST_ID = ?)";
            $query = $db->prepare($sql);
            $query->execute([$test_id]);
            $result = $query->setFetchMode(PDO::FETCH_ASSOC);

            $questionsArray = $query->fetchAll();
            for ($i = 0; $i < count($questionsArray); $i++) {
                $response_array[$i]['test_id'] = json_decode(htmlspecialchars_decode($test_id));
                $response_array[$i]['question'] = json_decode(htmlspecialchars_decode($questionsArray[$i]['QUESTION']));
                $response_array[$i]['choices'] = json_decode(htmlspecialchars_decode($questionsArray[$i]['QUESTION_DATA']));
                $response_array[$i]['answer'] = json_decode(htmlspecialchars_decode($questionsArray[$i]['ANSWERS']));
                $response_array[$i]['type'] = json_decode(htmlspecialchars_decode($questionsArray[$i]['QUESTION_TYPE']));
                $response_array[$i]['isRandom'] = json_decode(htmlspecialchars_decode($questionsArray[$i]['ISRANDOM']));
                $response_array[$i]['id'] = json_decode(htmlspecialchars_decode($questionsArray[$i]['QUESTIONS_ID']));
                $response_array[$i]['path'] = json_decode(htmlspecialchars_decode($questionsArray[$i]['QUESTION_IMAGE']));
                $response_array[$i]['hasImage'] = !empty($response_array[$i]['path']);
                $response_array[$i]['order'] = json_decode(htmlspecialchars_decode($questionsArray[$i]['QUESTION_ORDER']));
                $response_array[$i]['saved'] = true;

            }
            return $response_array;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public static function getQuestionsForSolving($test_id)
    {
        $db = new Database;
        try {
            $questions = [];
            $answers = [];
            $response_array = [];
            $sql = "SELECT
            questions.TEST_ID,
            questions.QUESTIONS_ID,
            questions.QUESTION,
            questions.QUESTION_IMAGE,
            questions.QUESTION_DATA,
            questions.QUESTION_TYPE,
            questions.ISRANDOM,
            questions.QUESTION_ORDER,
            solving.ANSWER,
            questions.ANSWERS TRUE_ANSWER,
            solving.SOLVING_ID,
            (CASE
                WHEN tests.GIVEN_TIME * 60 - TIMESTAMPDIFF(
                    SECOND,
                    result.START_TIME,
                NOW()) <= 0 
                OR tests.ENDING_TIME <= NOW() THEN 0 WHEN ADDDATE( NOW(), INTERVAL tests.GIVEN_TIME MINUTE ) >= tests.ENDING_TIME THEN
                    TIMESTAMPDIFF( SECOND, NOW(), tests.ENDING_TIME ) ELSE tests.GIVEN_TIME * 60 - TIMESTAMPDIFF(
                        SECOND,
                        result.START_TIME,
                    NOW()) 
                END) / 60 REMAINED_MINUTE 
        FROM
            questions
            LEFT JOIN solving ON questions.QUESTIONS_ID = solving.QUESTION_ID AND solving.USER_ID = :user_id 
            LEFT JOIN tests ON tests.TEST_ID = questions.TEST_ID
            LEFT JOIN result ON result.TEST_ID = questions.TEST_ID AND result.USER_ID = :user_id 
        WHERE
            questions.TEST_ID = :test_id 
        ORDER BY
            questions.QUESTIONS_ID";
            $query = $db->prepare($sql);
            $query->execute([
                              ":test_id"=>$test_id,
                              ":user_id"=>Session::get(USER_ID)
            ]);
            $result = $query->setFetchMode(PDO::FETCH_ASSOC);
            $questionsArray = $query->fetchAll();
            // echo "<pre>";
            // print_r($questionsArray);die;
            for ($i = 0; $i < count($questionsArray); $i++) {
                $questions[$i]['id'] = json_decode(htmlspecialchars_decode($questionsArray[$i]['QUESTIONS_ID']));
                $questions[$i]['question'] = json_decode(htmlspecialchars_decode($questionsArray[$i]['QUESTION']));
                $questions[$i]['isRandom'] = json_decode(htmlspecialchars_decode($questionsArray[$i]['ISRANDOM']));
                $isRandom = json_decode(htmlspecialchars_decode($questionsArray[$i]['ISRANDOM']));
                $questions[$i]['path'] = json_decode(htmlspecialchars_decode($questionsArray[$i]['QUESTION_IMAGE']));
                $questions[$i]['hasImage'] = !empty($questions[$i]['path']);
                $questions[$i]['type'] = json_decode(htmlspecialchars_decode($questionsArray[$i]['QUESTION_TYPE']));
                $questions[$i]['answer'] = json_decode(htmlspecialchars_decode($questionsArray[$i]['ANSWER']));
                $choices = json_decode(htmlspecialchars_decode($questionsArray[$i]['QUESTION_DATA']));
                if($questions[$i]['type']=='single-choice'||$questions[$i]['type']=='multi-choice'||$questions[$i]['type']=='true-false'){
                    $choices = Helper::insertAnswersToChoices($questions[$i]['answer'],$choices);
                }

                if($questions[$i]['type']=='matching'){
                    $choices = Helper::clarifyMatching($choices);
                    if(empty($questions[$i]['answer'])){
                        $questions[$i]['answer'] = json_decode(htmlspecialchars_decode($questionsArray[$i]['TRUE_ANSWER']));
                        shuffle($questions[$i]['answer']);
                    }
                }else{
                    $isRandom == 1 && !empty($choices) ? shuffle($choices) : $choices;
                } 
                $questions[$i]['choices'] = $choices;
                $questions[$i]['test_id'] = json_decode(htmlspecialchars_decode($test_id));
                $questions[$i]['solving_id'] = json_decode(htmlspecialchars_decode($questionsArray[$i]['SOLVING_ID']));
                $questions[$i]['remained_minute'] = $questionsArray[$i]['REMAINED_MINUTE'];

                $answers[$i]['id'] = json_decode(htmlspecialchars_decode($questionsArray[$i]['QUESTIONS_ID']));
                $answers[$i]['answer'] = $questions[$i]['answer'];
                $answers[$i]['type'] = $questions[$i]['type'];
            }

            $response_array['answers'] = $answers;
            $response_array['questions'] = $questions;
            return $response_array;
        } catch (Exception $e) {
            echo $e;
        }
    }




}