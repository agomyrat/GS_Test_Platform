<?php

class Others extends Model
{


   /**
    * 
    *
    * @author Agamyrat C
    *
    */
   public static function get()
   {
      $db = new Database;
      try {
         $ar_as = array();
         $sql = 'SELECT * FROM others';
         $query = $db->prepare($sql);
         $query->execute();
         $data_all = [];
         while ($row = $query->fetch(PDO::FETCH_OBJ)) {
            $data[$row->KEY] = $row->VALUE;
         }
         return $data;
      } catch (Exception $e) {
         echo $e;
      }
      return false;
   }
}
