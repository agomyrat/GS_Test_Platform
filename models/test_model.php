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

    public static function updateTest($testId, $array)
    {
        $db = new Database;
        $testId = $array['testId'];
        $name = $array['name'];
        $description = $array['description'];
        $language = $array['language'];
        $isPublic = $array['isPublic'];
        $password = $array['password'];
        $fileName = $array['fileName'];
        $givenTime = $array['givenTime'];
        $startTime = $array['startTime'];
        $deadline = $array['deadline'];
        $isRandom = $array['isRandom'];
        $user_id = $array['user_id'];
        $isAllowed = empty($isPublic);
        // print_r($array);die;
        try {
            $sql = "UPDATE tests set `TEST_NAME` = :name,
                                  `DESCRIPTION` = :description,
                                  `CREATED_BY` = :user_id,
                                  `IS_RANDOM` = :isRandom,
                                  `IS_PUBLIC` = :isPublic,
                                  `IS_ALLOWED` = :isAllowed,
                                  `PASSWORD` = :password,
                                  `TEST_IMAGE` = :fileName,
                                  `LANGUAGE` = :language,
                                  `STARTING_TIME` = :startTime,
                                  `ENDING_TIME` = :deadline,
                                  `GIVEN_TIME` = :givenTime
                              WHERE TEST_ID = :testId";

            $query = $db->prepare($sql);
            //var_dump($query);
            $query->execute(
                [
                    ':testId' => $testId,
                    ':name' => $name,
                    ':description' => $description,
                    ':language' => $language,
                    ':isPublic' => $isPublic,
                    ':password' => $password,
                    ':fileName' => $fileName,
                    ':givenTime' => $givenTime,
                    ':startTime' => $startTime,
                    ':deadline' => $deadline,
                    ':isRandom' => $isRandom,
                    ':user_id' => $user_id,
                    ':isAllowed' => $isAllowed
                ]
            );
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
            return false;
        }
        return true;
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
        return (bool) $query->fetch();
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
     * Popular testlary alyp gelyar 
     * 
     * @param int $start nacenji testdan bashlajagy. Default 0
     * @param int $limit naceden aljagy. Default = 10 
     * @param string $search_text search ucin goyuldy default ''
     * @param string $language dile gora search ucin goyuldy default ahli diller. Ugratmak cuin TM, EN, RU. ! EGERDE BIR DIL GOYSAN HER SCROLLDA UGRATMANY UNUTMA
     * @return array 
     * @author Agamyrat C.
     * 
     */
    public static function getPopularTests($start = 0, $limit = 10, $search_text = '', $language = '')
    {
        try {
            $data_all = [];
            $db = new Database;
            if ($language != '') {
                $language = ' AND tests.LANGUAGE = "' . $language . '" ';
            }

            $sql = 'SELECT 
                    users.USER_ID, 
                    CONCAT("@",users.USER_NAME) USER_NAME, 
                    tests.TEST_ID, 
                    tests.TEST_NAME, 
                    tests.DESCRIPTION,
                    tests.TEST_IMAGE, 
                    LIKE_COUNT, 
                    DISLIKE_COUNT, 
                    SOLVING_COUNT, 
                    DATE_FORMAT(tests.CREATE_TIME,\'%d.%m.%Y\') CREATED_DATE
            FROM tests
            LEFT JOIN users ON users.USER_ID = tests.CREATED_BY
            WHERE tests.IS_PUBLIC = 1 AND tests.IS_ALLOWED = 1 AND (tests.DESCRIPTION LIKE :search_text or tests.TEST_NAME LIKE :search_text or tests.KEYWORDS LIKE :search_text) 
            ' . $language . '
            ORDER BY SOLVING_COUNT DESC
            LIMIT ' . (int)$start . ', ' . (int)$limit;
            $query = $db->prepare($sql);
            $query->execute(
                [
                    ':search_text' => "%$search_text%",
                ]
            );

            while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                $data = null;
                $data['USER_ID'] = $row->USER_ID;
                $data['USER_NAME'] = $row->USER_NAME;
                $data['TEST_ID'] = $row->TEST_ID;
                $data['TEST_NAME'] = $row->TEST_NAME;
                $data['LIKE_COUNT'] = $row->LIKE_COUNT;
                $data['SOLVING_COUNT'] = $row->SOLVING_COUNT;
                $data['CREATED_DATE'] = $row->CREATED_DATE;
                $data['TEST_IMAGE'] = $row->TEST_IMAGE;
                $data_all[] = $data;
            }
            if (count($data_all)) {
                return $data_all;
            } else {
                return false;
            }
            // return $query->debugDumpParams();
        } catch (Exception $e) {
            echo $e;
            return false;
        }
    }

    /**
     * Popular sanyna gora order by  
     * 
     * @param int $limit Test sany. Egerde bosh ugratsan hemmesini alyp berya
     * @return array 
     * @author Agamyrat C.
     * 
     */
    public static function getTopTests($start = 0, $limit = 10, $search_text = '', $language = '')
    {
        try {
            $data_all = [];
            $db = new Database;
            if ($language != '') {
                $language = ' AND tests.LANGUAGE = "' . $language . '" ';
            }

            $sql = 'SELECT 
                    users.USER_ID, 
                    CONCAT("@",users.USER_NAME) USER_NAME, 
                    tests.TEST_ID, 
                    tests.TEST_NAME, 
                    tests.DESCRIPTION,
                    tests.TEST_IMAGE, 
                    LIKE_COUNT, 
                    DISLIKE_COUNT, 
                    SOLVING_COUNT, 
                    DATE_FORMAT(tests.CREATE_TIME,\'%d.%m.%Y\') CREATED_DATE
            FROM tests
            LEFT JOIN users ON users.USER_ID = tests.CREATED_BY
            WHERE tests.IS_PUBLIC = 1 AND tests.IS_ALLOWED = 1 AND (tests.DESCRIPTION LIKE :search_text or tests.TEST_NAME LIKE :search_text or tests.KEYWORDS LIKE :search_text) 
            ' . $language . '
            ORDER BY (LIKE_COUNT - DISLIKE_COUNT)*2 + SOLVING_COUNT DESC
            LIMIT ' . (int)$start . ', ' . (int)$limit;
            $query = $db->prepare($sql);
            $query->execute(
                [
                    ':search_text' => "%$search_text%",
                ]
            );

            while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                $data = null;
                $data['USER_ID'] = $row->USER_ID;
                $data['USER_NAME'] = $row->USER_NAME;
                $data['TEST_ID'] = $row->TEST_ID;
                $data['TEST_NAME'] = $row->TEST_NAME;
                $data['LIKE_COUNT'] = $row->LIKE_COUNT;
                $data['SOLVING_COUNT'] = $row->SOLVING_COUNT;
                $data['CREATED_DATE'] = $row->CREATED_DATE;
                $data['TEST_IMAGE'] = $row->TEST_IMAGE;
                $data_all[] = $data;
            }
            if (count($data_all)) {
                return $data_all;
            } else {
                return false;
            }
            // return $query->debugDumpParams();
        } catch (Exception $e) {
            echo $e;
            return false;
        }
    }


    /**
     * On cozen testlary yada cozmage bashlan 
     * 
     * @param int user_id USER_ID
     * @param int $limit Test sany. Egerde bosh ugratsan hemmesini alyp berya
     * @return array 
     * @author Agamyrat C.
     * 
     */
    public static function getMyHistory($user_id, $start = 0, $limit = 10, $search_text = '', $language = '')
    {
        try {
            $data_all = [];
            $db = new Database;
            if ($language != '') {
                $language = ' AND tests.LANGUAGE = "' . $language . '" ';
            }

            $sql = 'SELECT 
                    users.USER_ID, 
                    CONCAT("@",users.USER_NAME) USER_NAME, 
                    tests.TEST_ID, 
                    tests.TEST_NAME, 
                    tests.DESCRIPTION,
                    tests.TEST_IMAGE, 
                    tests.LIKE_COUNT, 
                    tests.DISLIKE_COUNT, 
                    tests.SOLVING_COUNT, 
                    DATE_FORMAT(tests.CREATE_TIME,\'%d.%m.%Y\') CREATED_DATE
            FROM result
            LEFT JOIN tests ON tests.TEST_ID = result.TEST_ID
            LEFT JOIN users ON users.USER_ID = tests.CREATED_BY
            WHERE result.USER_ID = :user_id AND (tests.DESCRIPTION LIKE :search_text or tests.TEST_NAME LIKE :search_text or tests.KEYWORDS LIKE :search_text) 
            ' . $language . '
            ORDER BY result.START_TIME DESC
            LIMIT ' . (int)$start . ', ' . (int)$limit;
            $query = $db->prepare($sql);
            $query->execute(
                [
                    ':search_text' => "%$search_text%",
                    ':user_id' => $user_id,
                ]
            );

            while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                $data = null;
                $data['USER_ID'] = $row->USER_ID;
                $data['USER_NAME'] = $row->USER_NAME;
                $data['TEST_ID'] = $row->TEST_ID;
                $data['TEST_NAME'] = $row->TEST_NAME;
                $data['LIKE_COUNT'] = $row->LIKE_COUNT;
                $data['SOLVING_COUNT'] = $row->SOLVING_COUNT;
                $data['CREATED_DATE'] = $row->CREATED_DATE;
                $data['TEST_IMAGE'] = $row->TEST_IMAGE;
                $data_all[] = $data;
            }
            if (count($data_all)) {
                return $data_all;
            } else {
                return false;
            }
            // return $query->debugDumpParams();
        } catch (Exception $e) {
            echo $e;
            return false;
        }
    }
    public static function getRecentTests($start = 0, $limit = 10, $search_text = '', $language = '')
    {
        try {
            $data_all = [];
            $db = new Database;
            if ($language != '') {
                $language = ' AND tests.LANGUAGE = "' . $language . '" ';
            }

            $sql = 'SELECT 
                    users.USER_ID, 
                    CONCAT("@",users.USER_NAME) USER_NAME, 
                    tests.TEST_ID, 
                    tests.TEST_NAME, 
                    tests.DESCRIPTION,
                    tests.TEST_IMAGE, 
                    LIKE_COUNT, 
                    DISLIKE_COUNT, 
                    SOLVING_COUNT, 
                    DATE_FORMAT(tests.CREATE_TIME,\'%d.%m.%Y\') CREATED_DATE
            FROM tests
            LEFT JOIN users ON users.USER_ID = tests.CREATED_BY
            WHERE tests.IS_PUBLIC = 1 AND tests.IS_ALLOWED = 1 AND (tests.DESCRIPTION LIKE :search_text or tests.TEST_NAME LIKE :search_text or tests.KEYWORDS LIKE :search_text) 
            ' . $language . '
            ORDER BY LAST_UPDATE_TIME DESC
            LIMIT ' . (int)$start . ', ' . (int)$limit;
            $query = $db->prepare($sql);
            $query->execute(
                [
                    ':search_text' => "%$search_text%",
                ]
            );

            while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                $data = null;
                $data['USER_ID'] = $row->USER_ID;
                $data['USER_NAME'] = $row->USER_NAME;
                $data['TEST_ID'] = $row->TEST_ID;
                $data['TEST_NAME'] = $row->TEST_NAME;
                $data['LIKE_COUNT'] = $row->LIKE_COUNT;
                $data['SOLVING_COUNT'] = $row->SOLVING_COUNT;
                $data['CREATED_DATE'] = $row->CREATED_DATE;
                $data['TEST_IMAGE'] = $row->TEST_IMAGE;
                $data_all[] = $data;
            }
            if (count($data_all)) {
                return $data_all;
            } else {
                return false;
            }
            // return $query->debugDumpParams();
        } catch (Exception $e) {
            echo $e;
            return false;
        }
    }

    public static function getMyPinnedTests($user_id, $start = 0, $limit = 10, $search_text = '', $language = '')
    {
        try {
            $data_all = [];
            $db = new Database;
            if ($language != '') {
                $language = ' AND tests.LANGUAGE = "' . $language . '" ';
            }
            $sql = 'SELECT 
                        tests.CREATED_BY, 
                        CONCAT("@", users.USER_NAME) USER_NAME,
                        tests.TEST_ID, 
                        tests.TEST_NAME, 
                        tests.DESCRIPTION,
                        tests.TEST_IMAGE, 
                        LIKE_COUNT, 
                        DISLIKE_COUNT, 
                        SOLVING_COUNT, 
                        DATE_FORMAT(pinned_test.CREATE_TIME,\'%d.%m.%Y\') CREATED_DATE
           FROM pinned_test
           LEFT JOIN tests on tests.TEST_ID = pinned_test.TEST_ID
           LEFT JOIN users ON tests.CREATED_BY = users.USER_ID
           WHERE pinned_test.USER_ID = :user_id
           and (tests.DESCRIPTION LIKE :search_text or tests.TEST_NAME LIKE :search_text or tests.KEYWORDS LIKE :search_text) 
            ' . $language . '
            ORDER BY pinned_test.CREATE_TIME DESC
            LIMIT ' . (int)$start . ', ' . (int)$limit;
            $query = $db->prepare($sql);
            $query->execute(
                [
                    ':search_text' => "%$search_text%",
                    ':user_id' => $user_id
                ]
            );

            while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                $data = null;
                $data['USER_ID'] = $row->CREATED_BY;
                $data['USER_NAME'] = $row->USER_NAME;
                $data['TEST_ID'] = $row->TEST_ID;
                $data['TEST_NAME'] = $row->TEST_NAME;
                $data['LIKE_COUNT'] = $row->LIKE_COUNT;
                $data['SOLVING_COUNT'] = $row->SOLVING_COUNT;
                $data['CREATED_DATE'] = $row->CREATED_DATE;
                $data['TEST_IMAGE'] = $row->TEST_IMAGE;
                $data_all[] = $data;
            }
            if (count($data_all)) {
                return $data_all;
            } else {
                return false;
            }
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
                END) REMAINED_MINUTE 
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
                ":test_id" => $test_id,
                ":user_id" => Session::get(USER_ID)
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
                if ($questions[$i]['type'] == 'single-choice' || $questions[$i]['type'] == 'multi-choice' || $questions[$i]['type'] == 'true-false') {
                    $choices = Helper::insertAnswersToChoices($questions[$i]['answer'], $choices);
                }

                if ($questions[$i]['type'] == 'matching') {
                    $choices = Helper::clarifyMatching($choices);
                    if (empty($questions[$i]['answer'])) {
                        $questions[$i]['answer'] = json_decode(htmlspecialchars_decode($questionsArray[$i]['TRUE_ANSWER']));
                        shuffle($questions[$i]['answer']);
                    }
                } else {
                    $isRandom == 1 && !empty($choices) ? shuffle($choices) : $choices;
                }
                $questions[$i]['choices'] = $choices;
                $questions[$i]['test_id'] = json_decode(htmlspecialchars_decode($test_id));
                $questions[$i]['solving_id'] = json_decode(htmlspecialchars_decode($questionsArray[$i]['SOLVING_ID']));
                $questions[$i]['remained_minute'] = $questionsArray[$i]['REMAINED_MINUTE'];

                $answers[$i]['id'] = json_decode(htmlspecialchars_decode($questionsArray[$i]['QUESTIONS_ID']));
                $answers[$i]['answer'] = $questions[$i]['answer'];
                $answers[$i]['type'] = $questions[$i]['type'];
                $answers[$i]['solving_id'] = json_decode(htmlspecialchars_decode($questionsArray[$i]['SOLVING_ID']));

                $remained_minutes = $questionsArray[$i]['REMAINED_MINUTE'];
            }

            $response_array['answers'] = $answers;
            $response_array['questions'] = $questions;
            $response_array['remained_minutes'] = $remained_minutes;
            return $response_array;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public static function getPreviewDatas($testId)
    {
        $db = new Database;
        try {
            $sql = "SELECT  tests.TEST_NAME,
                            tests.DESCRIPTION,
                            tests.IS_PUBLIC,
                            tests.TEST_IMAGE,
                            tests.LANGUAGE,
                            tests.STARTING_TIME,
                            tests.ENDING_TIME,
                            tests.GIVEN_TIME,
                            tests.SOLVING_COUNT,
                            tests.LIKE_COUNT,
                            tests.DISLIKE_COUNT,
                            tests.QUESTION_COUNT,
                            tests.CREATE_TIME,
                            users.USER_NAME,
                            users.FIRST_NAME,
                            users.SURNAME,
                            users.IMAGE
                    FROM
                    tests
                    LEFT JOIN users ON users.USER_ID = tests.CREATED_BY
                    WHERE
                    tests.TEST_ID = :testId";
            $query = $db->prepare($sql);
            $query->execute([':testId' => $testId]);
            $result = $query->setFetchMode(PDO::FETCH_ASSOC);
            $fetchedDatas = $query->fetch();

            $returnDatas = [];
            $returnDatas["TEST_NAME"] = $fetchedDatas['TEST_NAME'];
            $returnDatas["DESCRIPTION"] = $fetchedDatas['DESCRIPTION'];
            $returnDatas["LANGUAGE"] = $fetchedDatas['LANGUAGE'];
            $returnDatas["IS_PUBLIC"] = $fetchedDatas['IS_PUBLIC'];
            $returnDatas["TEST_IMAGE"] = !empty($fetchedDatas['TEST_IMAGE']) ? $fetchedDatas['TEST_IMAGE'] : 'profile.jpg';
            $returnDatas["GIVEN_TIME"] = $fetchedDatas['GIVEN_TIME'];
            $returnDatas["STARTING_TIME"] = $fetchedDatas['STARTING_TIME'];
            $returnDatas["ENDING_TIME"] = $fetchedDatas['ENDING_TIME'];
            $returnDatas["USER_NAME"] = $fetchedDatas['USER_NAME'];
            $returnDatas['FIRST_NAME'] = $fetchedDatas['FIRST_NAME'];
            $returnDatas['SURNAME'] = $fetchedDatas['SURNAME'];
            $returnDatas['QUESTION_COUNT'] = $fetchedDatas['QUESTION_COUNT'];
            $returnDatas['LIKE_COUNT'] = $fetchedDatas['LIKE_COUNT'];
            $returnDatas['DISLIKE_COUNT'] = $fetchedDatas['DISLIKE_COUNT'];
            $returnDatas['SOLVING_COUNT'] = $fetchedDatas['SOLVING_COUNT'];
            $returnDatas['CREATE_TIME'] = $fetchedDatas['CREATE_TIME'];
            $returnDatas['IMAGE'] = !empty($fetchedDatas['IMAGE']) ? $fetchedDatas['IMAGE'] : 'profile.jpg';


            return $returnDatas;
        } catch (Exception $e) {
            var_dump($e);
        }
    }

    public static function canEdit($test_id, $user_id)
    {
        $db = new Database;
        try {
            $sql = 'SELECT 
                    CASE WHEN tests.CREATED_BY <> :user_id THEN FALSE -- TESTIN EYESI DAL
                        WHEN SUM(result.USER_ID) > 0 THEN FALSE -- ON BIRI COZEN BOLSA RUGSAT YOK
                        WHEN tests.STARTING_TIME <= NOW() AND tests.ENDING_TIME > NOW() THEN FALSE -- COZMEK UCIN AMATLY VAGT (HER PURSAT COZUP BILERLER)
                        WHEN tests.IS_PUBLIC = 1 AND tests.IS_ALLOWED = 1 THEN FALSE -- PUBLIC RUGSAT BERILEN (HER PURSAT COZUP BILERLER)
                        
                        ELSE TRUE END CAN_EDIT
                    FROM
                    tests 
                    LEFT JOIN result ON result.TEST_ID = tests.TEST_ID
                    WHERE tests.TEST_ID = :test_id';
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


    public static function checkTime($test_id, $user_id)
    {
        $db = new Database;
        try {
            $sql = 'SELECT
                        CASE
                            WHEN tests.GIVEN_TIME * 60 - TIMESTAMPDIFF(
                                SECOND,
                                result.START_TIME,
                            NOW()) <= 0 
                            OR tests.ENDING_TIME <= NOW() THEN 0 WHEN ADDDATE( NOW(), INTERVAL tests.GIVEN_TIME MINUTE ) >= tests.ENDING_TIME THEN
                                TIMESTAMPDIFF( SECOND, NOW(), tests.ENDING_TIME ) ELSE tests.GIVEN_TIME * 60 - TIMESTAMPDIFF(
                                    SECOND,
                                    result.START_TIME,
                                NOW()) 
                            END GALAN_SECUNT 
                    FROM
                        tests
                        LEFT JOIN result ON result.TEST_ID = tests.TEST_ID  
                    WHERE
                        tests.TEST_ID = :test_id 
                        AND result.USER_ID = :user_id ';
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

    public static function getMyTests($user_id, $start = 0, $limit = 10, $search_text = '', $language = '')
    {
        try {
            $data_all = [];
            $db = new Database;
            if ($language != '') {
                $language = ' AND tests.LANGUAGE = "' . $language . '" ';
            }

            $sql = 'SELECT 
                    tests.TEST_ID, 
                    tests.TEST_NAME, 
                    tests.DESCRIPTION,
                    tests.TEST_IMAGE, 
                    LIKE_COUNT, 
                    DISLIKE_COUNT, 
                    SOLVING_COUNT, 
                    DATE_FORMAT(tests.CREATE_TIME,\'%d.%m.%Y\') CREATED_DATE
            FROM tests
            LEFT JOIN users ON users.USER_ID = tests.CREATED_BY
            WHERE tests.REMOVED = 0 AND tests.CREATED_BY = :user_id AND (tests.DESCRIPTION LIKE :search_text or tests.TEST_NAME LIKE :search_text or tests.KEYWORDS LIKE :search_text) 
            ' . $language . '
            ORDER BY tests.LAST_UPDATE_TIME DESC
            LIMIT ' . (int)$start . ', ' . (int)$limit;
            $query = $db->prepare($sql);
            $query->execute(
                [
                    ':search_text' => "%$search_text%",
                    ':user_id' => $user_id
                ]
            );

            while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                $data = null;
                $data['TEST_ID'] = $row->TEST_ID;
                $data['TEST_NAME'] = $row->TEST_NAME;
                $data['LIKE_COUNT'] = $row->LIKE_COUNT;
                $data['SOLVING_COUNT'] = $row->SOLVING_COUNT;
                $data['CREATED_DATE'] = $row->CREATED_DATE;
                $data['TEST_IMAGE'] = $row->TEST_IMAGE;
                $data_all[] = $data;
            }
            if (count($data_all)) {
                return $data_all;
            } else {
                return false;
            }
            // return $query->debugDumpParams();
        } catch (Exception $e) {
            echo $e;
            return false;
        }
    }

    /**
     * Testy kopyalamak ucin.
     *
     * @param int $test_id kopyalanjak testyn idsy
     * @param int $user_id kopyalanyan test kimin adyna kopyalamaly
     * @author Agamyrat C
     *
     */
    public static function copyTest($test_id, $user_id)
    {
        echo $test_id;
        $db = new Database;
        try {
            // ? TEST TABLOSUNDA ROW EKLENMEGI UCIN
            $sql_test = 'SELECT TEST_NAME, DESCRIPTION, IS_RANDOM, IS_PUBLIC, `PASSWORD`, TEST_IMAGE, `LANGUAGE` , KEYWORDS, GIVEN_TIME FROM `tests` WHERE (TEST_ID = :test_id)';
            $query_test = $db->prepare($sql_test);
            $query_test->execute([
                ":test_id" => $test_id
            ]);
            $test = $query_test->fetch(PDO::FETCH_OBJ);


            /**
             * TODO: IMAGE ALMALY COPY ETMELI, TAZE ADYNY NEW_IMG_NAME GOYMALY,
             * TODO: TEST_NAME SONUNA COPY SOZUNI GOSHUP GOYVERAY COPYALANANDYGY BELLI BOLUP DURSUN, SON TAZEDEN AT BERSIN
             */
            $new_img_name = Helper::copyUploadedImage($test->TEST_IMAGE);

            $sql_test_insert = 'INSERT INTO `tests`(CREATED_BY, TEST_NAME, DESCRIPTION, IS_RANDOM, `PASSWORD`, TEST_IMAGE, `LANGUAGE` , KEYWORDS, GIVEN_TIME) VALUES(:user_id, :test_name, :description, :is_random, :password, :test_image, :language, :keywords, :given_time);';
            $query_test_insert = $db->prepare($sql_test_insert);
            $query_test_insert->execute([
                ':user_id' => $user_id,
                ':test_name' => $test->TEST_NAME,
                ':description' => $test->DESCRIPTION,
                ':is_random' => $test->IS_RANDOM,
                ':password' => $test->PASSWORD,
                ':test_image' => $new_img_name,
                ':language' => $test->LANGUAGE,
                ':keywords' => $test->KEYWORDS,
                ':given_time' => $test->GIVEN_TIME,
            ]);
            $copy_test_id = $db->lastInsertId(); // insert edilenden son insert edilen row id sy. taze test id



            // QUESTION LARY TEK-TEK ALYP IMAGE BAR BOLSA FILELARY YERINE GOYUP ADYNY UYTGETMELI
            $sql_questions = 'SELECT QUESTION, QUESTION_IMAGE, QUESTION_DATA, ANSWERS, QUESTION_ORDER, QUESTION_TYPE, ISRANDOM FROM `questions` WHERE (TEST_ID =:test_id) ORDER BY QUESTIONS_ID';

            $query_questions = $db->prepare($sql_questions);
            $query_questions->execute([
                ":test_id" => $test_id
            ]);

            while ($row = $query_questions->fetch(PDO::FETCH_OBJ)) {
                //echo $row->QUESTION;
                $question_data = json_decode(htmlspecialchars_decode($row->QUESTION_DATA));
                $question_image = json_decode(htmlspecialchars_decode($row->QUESTION_IMAGE));
                //copy question image
                $question_image = Helper::copyUploadedImage($question_image);

                //copy choice images
                if (is_array($question_data)) {
                    for ($i = 0; $i < count($question_data); $i++) {
                        if (!empty($question_data[$i]->path)) {
                            $question_data[$i]->path = Helper::copyUploadedImage($question_data[$i]->path);
                        }
                    }
                }

                /**
                 * TODO: data-daky ve image daky suratlary almaly, taze at bermeli, yerine goymaly(file), tazeden data,image duzmeli
                 */
                $new_question_data = 'taze data etmeli';
                $new_question_image = 'taze image etmeli';

                $sql_question_insert = 'INSERT INTO `questions`(TEST_ID, QUESTION, QUESTION_IMAGE, QUESTION_DATA, ANSWERS, QUESTION_ORDER, QUESTION_TYPE, ISRANDOM) VALUES (:test_id, :question, :question_image, :question_data, :answers, :question_order, :question_type, :israndom);';
                $db->prepare($sql_question_insert)->execute([
                    ':test_id' => $copy_test_id,
                    ':question' => $row->QUESTION,
                    ':question_image' => htmlspecialchars(json_encode($question_image)),
                    ':question_data' => htmlspecialchars(json_encode($question_data)),
                    ':answers' => $row->ANSWERS,
                    ':question_order' => $row->QUESTION_ORDER,
                    ':question_type' => $row->QUESTION_TYPE,
                    ':israndom' => $row->ISRANDOM
                ]);
            }
        } catch (Exception $e) {
            echo $e;
        }
    }
}
