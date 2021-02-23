<?php 


  class Database{
      private $dsn = "mysql:host=localhost; dbname=php_crud_2021";        // server hostname 
      private $dbuser = "root";                                          // database user name
      private $dbpass = "";                                             // database password
      private $pdo;                                                    // connection variable

      public function __construct()
      {
          if(!isset($this->pdo)){
              try{
                $link = new PDO($this->dsn, $this->dbuser, $this->dbpass);
                $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $link->exec("SET CHARACTER SET utf8");
                $this->pdo = $link;
              }
              catch (PDOException $e){
                die("<h6 style='text-align:center;'>Failed to connect database .". $e->getMessage()."<br/>"."Click to <a href='mailto:jahidhasan1000101@gmail.com'>Get Help </a> </h6>");
              }
          }
      }
  
      // to insert data 
      public function insert($table, $data){
        if(!empty($data) && is_array($data)){
          $keys = implode(", ", array_keys($data));
          $values ="'". implode("','", array_values($data))."'";

          $sql = "INSERT INTO ".$table." (".$keys.") VALUES (".$values.")" ;
          $this->pdo->prepare($sql);
          
          $this->pdo->exec($sql);
          


      }}

       // to read data 
       public function select($table, $data=array()){
          $sql  = 'SELECT ';
          $sql .= array_key_exists('select', $data)?$data['select']:'*';
          $sql .= ' FROM '.$table;
          
           if (array_key_exists('where', $data )){
             $sql .= " WHERE ";
             $i = 0;
             foreach($data['where'] as $key => $value){
               $add = ($i > 0)?' AND ':'';
               $sql .= $add.$key."="."'{$value}'";
               $i++;
             }
           }
          
          $result = $this->pdo->prepare($sql);

           if (array_key_exists('where', $data )){
             $result->bindValue(':$key', $value);
           }

          $result->execute();

          return $result->fetchAll();
    }

     // to update data 
     public function update(){
          
    }

     // to delete data 
     public function delete(){
          
    }

    public function test($table, $data){
      if(!empty($data) && is_array($data)){
        $keys = implode(", ", array_keys($data));
        $values =":". implode(", :", array_values($data));

        $sql = "INSERT INTO ".$table." (".$keys.") VALUES (".$values.")" ;
        $query = $this->pdo->prepare($sql);

        foreach($data as $k => &$v){
         $bind= $query->bindValue($k,$v);
         echo "test <br>";
        }
        $query->execute();


        
        return $bind;
    }}






  }
?>