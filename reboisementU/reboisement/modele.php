<?php
  //modele.php
  //require("connect.php");
  $dbConnect=connect_db();

  function connect_db()
  {
      $dsn="mysql:dbname=reboisement;host=localhost:3306";

  try
  {

      $connexion=new PDO($dsn,'root','');

      $connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

      $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


  }
  catch(PDOException $e)
  {
  printf("Echec connexion : %s\n",
  $e->getMessage());
  exit();
  }
  return $connexion;
  }

  function getUsers()
  {
      $connexion=connect_db();
      $user=Array();
      $sql="SELECT * from users";
      foreach ($connexion->query($sql) as $row)
      {
           $user[]=$row;
      }

      return $user;
  }

  function getDataToLoad($sqlText)
  {

      $connexion=connect_db();

      $result=Array();

     foreach ($connexion->query($sqlText) as $row)
      {

           $result[]=$row;
      }

      return $result;
  }


  function getDataToLoadAjax($sqlText)
 {


     $connexion=connect_db();

      $result=Array();

      $stmt = $connexion->query($sqlText);
      $info = $stmt->fetchAll();

     if (isset($info)){

          foreach ($info as $row)
           {
            $result[]= array_map('utf8_encode', $row);
           }
        } else {

              $result[]=[];
          }
      return $result;

 }

  function authentication($userName,$password)
  {
      $sqlText = "select count(username) from users where username='$userName' and pass='".md5($password)."'";
      $connexion=connect_db();
      $result = $connexion->query($sqlText);
      $count = $result->fetchColumn();

      $vret = $count>0 ? true : false;


      return $vret;
  }


  function setDropDownList($tableName,$key,$Value,$whereKey)
  {
      $connexion=connect_db();
      $result=Array();
      $sql="SELECT ".$key." as cle ,".$Value. " as valeur "." from ".$tableName. " where 1=1 ".$whereKey;


      foreach ($connexion->query($sql) as $row)
      {
           $result[]=$row;
      }

      return $result;
  }

  function addData($configFile,$tableName,$Values)
  {

      $config = parse_ini_file($configFile, true);

      $colsName = $config[$tableName.'-column'];
      $nbCol=0;
      $sqlInsert = "insert into ".$tableName."(";
      foreach ($colsName as $value) {
        if ($value['type']!=='affichage'){
          $nbCol++;
          $sqlInsert=$sqlInsert.$value['nom'].",";
        }

      }
      $sqlInsert=substr($sqlInsert, 0, -1);
      $sqlInsert=$sqlInsert.") values (";


      $sqlInsert=$sqlInsert.substr(str_pad("",$nbCol*2,"?,"),0,-1).")";


      $connexion=connect_db();
     try {
        $statement = $connexion->prepare($sqlInsert);
        $val= Array();
        foreach ($colsName as $item) {
          if ($item['type']!=='affichage'){
            $val[]=$Values[$item['nom']];
          }
        }

        $statement->execute($val);

        return 'Insertion terminée';
      }
     catch(PDOException $e) {
        return $e->getMessage();
    }
  }

 function updateData($configFile,$tableName,$oldsValues,$Values)
  {
     $config = parse_ini_file($configFile, true);
     $whereKeys=Array();

      $colsName = $config[$tableName.'-column'];

      $sqlUpdate = "update ".$tableName." set ";
      foreach ($colsName as $value) {

          $sqlUpdate=$sqlUpdate.$value['nom']."=?,";

      }



      $whereKeys = explode(",", $config[$tableName.'-data']["whereKey"]);
       $whereClause=" where 1=1 ";

      foreach ($whereKeys as $item) {
            $whereClause=$whereClause." and ".$item."=".$oldsValues[$item];
        }
      $sqlUpdate=substr($sqlUpdate,0,-1).$whereClause;
      try {
        global $dbConnect;
        $statement = $dbConnect->prepare($sqlUpdate);
        $val= Array();
        foreach ($colsName as $item) {
          if ($item['type']!=='affichage'){
              $val[]=$Values[$item['nom']];
          }
        }

        $statement->execute($val);
         print_r($statement->errorInfo());
        return 'Mise à jour terminée';
      } catch(PDOException $e) {
        return $e->getMessage();
    }

    }

  function deleteData($configFile,$tableName,$oldsValues,$Values)
  {
     $config = parse_ini_file($configFile, true);
     $whereKeys=Array();

      $colsName = $config[$tableName.'-column'];

      $sqlDelete = "delete from ".$tableName;

      $whereKeys = explode(",", $config[$tableName.'-data']["whereKey"]);
       $whereClause=" where 1=1 ";

      foreach ($whereKeys as $item) {
            $whereClause=$whereClause." and ".$item."=".$oldsValues[$item];
        }
      $sqlDelete=$sqlDelete.$whereClause;

      try {
            global $dbConnect;
            $statement = $dbConnect->prepare($sqlDelete);
            $statement->execute();
            return 'Suppression terminée';
        } catch(PDOException $e) {
            return $e->getMessage();
        }

    }


  ?>
