<?php

class DB {

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	

    public static function execute_sql($sql, $function = "") {
        //$sql = mysql_query($sql) or die(mysql_error()." ".$function);
        try {
            if ($sql = mysql_query($sql)) {
                return $sql;
            } else {
                throw new Exception(mysql_error());
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function num_rows($sql) {
        $sql = mysql_num_rows($sql); // or die(mysql_error()." ERROR num_rows");
        return $sql;
    }

    public static function last_insert() {
        $sql = mysql_insert_id() or die(mysql_error());
        return $sql;
    }

    public static function begin() {
        #mysql_query("BEGIN");
        mysql_query("START TRANSACTION");
    }

    public static function commit() {
        mysql_query("COMMIT");
    }

    public static function rollback() {
        mysql_query("ROLLBACK");
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
}

//Fin class db
/*
  $query = "INSERT INTO trans (id,item,quantity)
  values (null,'Baseball',4)";
  begin(); // transaction begins
  $result = @mysql_query($query);
  if(!$result){
  rollback(); // transaction rolls back
  echo "you rolled back";
  exit;
  }else{
  commit(); // transaction is committed
  echo "your insertion was successful";
  }
 */
?>