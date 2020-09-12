<?php

class Solving extends Model
{
    public static function insertAnswer($array)
    {
        $db = new Database;
        $questionId = $array['question_id'];
        $testId = $array['test_id'];
        $userId = $array['user_id'];
        $answer = $array['answer'];
        $true_false = $array['true_false'];
         //print_r($array);die;
        try {
            $sql = "INSERT INTO solving (`USER_ID`,`RESULT_ID`, `QUESTION_ID`, `ANSWER`, `TRUE_FALSE`)"
                . " VALUES (:userId,:resultId,:questionId,:answer,:true_false);";
            $query = $db->prepare($sql);
            //var_dump($query);
            $query->execute(
                [
                ':resultId' => 1,//Result::getResultID($testId,$userId);
                ':userId' => $userId,
                ':questionId' => $questionId,
                ':answer' => htmlspecialchars(json_encode($answer)),
                ':true_false' => htmlspecialchars(json_encode($true_false))
                ]
            );
            return $db->lastInsertId();
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
            return false;
        }
        return $db->lastInsertId();
        //$db=null;
    }

    public static function updateAnswer($solving_id,$array)
    {
        $db = new Database;
        $questionId = $array['question_id'];
        $testId = $array['test_id'];
        $userId = $array['user_id'];
        $answer = $array['answer'];
        $true_false = $array['true_false'];
         //print_r($array);die;
        try {
            $sql = "UPDATE solving SET `ANSWER`=:answer,
                                       `TRUE_FALSE`=:true_false
                    WHERE `SOLVING_ID`=:solving_id";
            $query = $db->prepare($sql);
            //var_dump($query);
            $query->execute(
                [
                ':answer' => htmlspecialchars(json_encode($answer)),
                ':true_false' => htmlspecialchars(json_encode($true_false)),
                ':solving_id' => htmlspecialchars(json_encode($solving_id))
                ]
            );
            return $solving_id;
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
            return false;
        }
        return $db->lastInsertId();
        //$db=null;
    }

    public static function has($solving_id)
    {
       $db = new Database;
 
       $sql = "SELECT COUNT(*) FROM solving WHERE SOLVING_ID = ?";
       $query = $db->prepare($sql);
       $query->execute([$solving_id]);
       return (bool) $query->fetch()[0];
    }
}
