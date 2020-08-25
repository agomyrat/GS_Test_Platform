<?php

class Question extends Model
{

    public $data = array();
    public $questionId;
    public $testId;
    public $question;
    public $questionImage;
    public $questionData;
    public $answers;
    public $questinoType;
    public $isRandom;

    public function __construct($question_id)
    {
        parent::__construct();
        try {
            $sql = 'SELECT * FROM questions WHERE (questions.QUESTIONS_ID = ?) LIMIT 1';
            $query = $this->db->prepare($sql);
            $query->execute([$question_id]);
            // var_dump($this->db);
            if ($query->rowCount() > 0) {
                $this->data = $query->fetch(PDO::FETCH_ASSOC);
                $this->questionId = $this->data['QUESTIONS_ID'];
                $this->testId = $this->data['TEST_ID'];
                $this->question = $this->data['QUESTION'];
                $this->questionImage = $this->data['QUESTIONS_IMAGE'];
                $this->questionData = $this->data['QUESTIONS_DATA'];
                $this->answers = $this->data['ANSWERS'];
                $this->questionType = $this->data['QUESTIONS_TYPE'];
                $this->isRandom = $this->data['ISRANDOM'];
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    public static function get($q_id, $columns)
    {
        $db = new Database;
        try {
            $ar_as = array();
            $sql = 'SELECT ' . htmlspecialchars(implode(',', $columns)) . ' FROM users WHERE (questions.QUESTIONS_ID = ?) LIMIT 1';
            $query = $db->prepare($sql);
            $query->execute([$q_id]);
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

    public static function set($q_id, $column, $new_value)
    {
        $db = new Database;
        try {
            $sql = 'UPDATE users SET ' . htmlspecialchars($column) . ' = :new_value WHERE (questions.QUESTIONS_ID = :q_id) LIMIT 1';
            $query = $db->prepare($sql);
            $query->bindParam(':new_value', $new_value, PDO::PARAM_STR);
            $query->bindParam(':q_id', $q_id, PDO::PARAM_INT);
            $query->execute();
            if ($query->rowCount() > 0) {
                return true;
            }
        } catch (Exception $e) {
            echo $e;
        }
        return false;
    }

    public static function insertQuestion($array = null)
    {
        $db = new Database;
        $testId = $array['testId'];
        $question = $array['question'];
        $questionImages = $array['questionImages'];
        $questionData = $array['questionData'];
        $choiceImages = $array['choiceImages'];
        $answers = $array['answers'];
        $questionType = $array['questionType'];
        $isRandom = $array['isRandom'];
        //print_r($array);
        try {
            $sql = "INSERT INTO questions (`TEST_ID`, `QUESTION`, `QUESTION_IMAGE`, `QUESTION_DATA`, `CHOICE_IMAGES`, `ANSWERS`,`QUESTION_TYPE`,`ISRANDOM`)"
                . " VALUES (:testId,:question,:questionImages,:questionData,:choiceImages,:answers,:questionType,:isRandom);";
            $query = $db->prepare($sql);
            //var_dump($query);
            $query->execute(
                [
                    ':testId' => htmlspecialchars($testId),
                    ':question' => htmlspecialchars($question),
                    ':questionImages' => htmlspecialchars($questionImages),
                    ':questionData' => htmlspecialchars($questionData),
                    ':choiceImages' => htmlspecialchars($choiceImages),
                    ':answers' => htmlspecialchars($answers),
                    ':questionType' => htmlspecialchars($questionType),
                    ':isRandom' => htmlspecialchars($isRandom),
                ]
            );
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
            return false;
        }
        return $db->lastInsertId();
    }

    public static function getQuestionId($column, $value)
    {
        $db = new Database;
        try {
            $sql = 'SELECT QUESTIONS_ID FROM questions WHERE (' . htmlspecialchars($column) . ' = ?) LIMIT 1';
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

    public static function getImageNames($questionId)
    {
        $db = new Database;
        $imagesArray = [];
        echo $questionId;
        try {
            $sql = "SELECT QUESTION_IMAGE, CHOICE_IMAGES FROM questions WHERE QUESTIONS_ID = ?";
            $query = $db->prepare($sql);
            $query->execute([$questionId]);
            if ($query->rowCount() > 0) {
                $images = $query->fetch(PDO::FETCH_ASSOC);

                $questionImages = json_decode(htmlspecialchars_decode($images['QUESTION_IMAGE']));
                $choiceImages = json_decode(htmlspecialchars_decode($images['CHOICE_IMAGES']));

                foreach ($questionImages as $image) {
                    array_push($imagesArray, $image);
                }

                foreach ($choiceImages as $image) {
                    array_push($imagesArray, $image);
                }
            }
        } catch (Exception $e) {
            echo $e;
        }

        return $imagesArray;
    }

    public static function deleteRow($questionId)
    {
        $db = new Database;
        try {
            $sql = "DELETE FROM questions WHERE QUESTIONS_ID = ?";
            $query = $db->prepare($sql);
            $query->execute([$questionId]);
        } catch (Exception $e) {
            echo $sql . "<br>" . $e->getMessage();
            return false;
        }

        return true;
    }

    public static function has($question_id)
    {
        $db = new Database;

        $sql = "SELECT COUNT(*) FROM questions WHERE QUESTIONS_ID = ?";
        $query = $db->prepare($sql);
        $query->execute([$question_id]);
        return (bool) $query->fetch()[0];
    }

    public static function getQuestionImages()
    {
        $db = new Database;
        //return //arraymi yada jsonmy;
    }

    public static function getChoiceImages()
    {
        $db = new Database;
        //return //arraymi yada jsonmy;
    }
}