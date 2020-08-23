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

    public static function getPopularTests()
    {
        $db = new Database;
        //return array of objects  e.g. ['test_id'=>object] //sanyny ozuniz kesgitlan belki 5 object belki 4
    }

    public static function getRecentTests()
    {
        $db = new Database;
        //return array of objects  e.g. ['test_id'=>object] //sanyny ozuniz kesgitlan belki 5 object belki 4
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
                $response_array[$i]['test_id'] = $test_id;
                $response_array[$i]['question'] = htmlspecialchars_decode($questionsArray[$i]['QUESTION']);
                $response_array[$i]['choices'] = json_decode(htmlspecialchars_decode($questionsArray[$i]['QUESTION_DATA']));
                $response_array[$i]['answer'] = json_decode(htmlspecialchars_decode($questionsArray[$i]['ANSWERS']));
                $response_array[$i]['type'] = htmlspecialchars_decode($questionsArray[$i]['QUESTION_TYPE']);
                $response_array[$i]['isRandom'] = htmlspecialchars_decode($questionsArray[$i]['ISRANDOM']);
                $response_array[$i]['id'] = htmlspecialchars_decode($questionsArray[$i]['QUESTIONS_ID']);
                $response_array[$i]['qFiles'] = json_decode(htmlspecialchars_decode($questionsArray[$i]['QUESTION_IMAGE']));
                $response_array[$i]['cFiles'] = json_decode(htmlspecialchars_decode($questionsArray[$i]['CHOICE_IMAGES']));
                $response_array[$i]['hasImage'] = !empty($response_array[$i]['qFiles']);

                if (is_array($response_array[$i]['cFiles'])) {
                    for ($j = 0; $j < count($response_array[$i]['cFiles']); $j++) {
                        $response_array[$i]['cFiles'][$j] = URL . 'uploads/' . $response_array[$i]['cFiles'][$j];
                    }
                }

                if (is_array($response_array[$i]['qFiles'])) {
                    for ($j = 0; $j < count($response_array[$i]['qFiles']); $j++) {
                        $response_array[$i]['qFiles'][$j] = URL . 'uploads/' . $response_array[$i]['qFiles'][$j];
                    }
                }
            }
            return $response_array;
        } catch (Exception $e) {
            echo $e;
        }
    }
}
