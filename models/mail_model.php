<?php

class Mail extends Model
{
    /**
     * Contact>Mail bolumundaki yazylyan maily DB set (insert) etyar
     * 
     * @param string $username Ulanyjy ady
     * @param string $email_address Ulanyjy email adresy
     * @param string $mail_text Mail texty 
     * @return bool true or false
     * @author Agamyrat C.
     * 
     */
    public static function setMail($username, $email_address, $mail_text)
    {
        try {
            $db = new Database;
            $sql = 'INSERT mails(USERNAME,EMAIL,MAIL_TEXT) VALUES(?,?,?)';
            $query = $db->prepare($sql);
            $query->execute([
                htmlspecialchars($username),
                htmlspecialchars($email_address),
                htmlspecialchars($mail_text)
            ]);
            return true;
        } catch (Exception $e) {
            echo $e;
            return false;
        }
    }


    /**
     * Ugradylan maily Moderator okandan son okady etmeli.
     * 
     * @param string $mail_id Okalan mail ID-sy
     * @return bool true or false
     * @author Agamyrat C.
     * 
     */
    public static function mailReaded($mail_id)
    {
        try {
            $db = new Database;
            $sql = 'UPDATE mails SET ACTIVE = 0 WHERE (MAIL_ID = ?)';
            $query = $db->prepare($sql);
            $query->execute([$mail_id]);
            return true;
        } catch (Exception $e) {
            echo $e;
            return false;
        }
    }
}
