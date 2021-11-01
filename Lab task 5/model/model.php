<?php
   class model{

       function db_conn()
      {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "product_db";

        try {
            $conn = new PDO('mysql:host='.$servername.';dbname='.$dbname.';charset=utf8', $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        return $conn;
       }

    function insert_info($data){

        $conn = $this->db_conn();

        $insertQuery = "INSERT into products (name, buying_price, selling_price, display)
        VALUES (:name, :buying_price, :selling_price, :display)";
            try{
                $stmt = $conn->prepare($insertQuery);
                $stmt->execute([
                    ':name'               =>     $data["name"],
                    ':buying_price'          =>      $data["buying_price"],
                    ':selling_price'     =>     $data["selling_price"],
                    ':display'     =>      $data["display"]
                ]);
            }catch(PDOException $e){
                echo "create ".$e->getMessage();
            }
            
            $conn = null;
    }

    function verify_unique_name($name){
        $conn = $this->db_conn();
        $selectQuery = 'SELECT * FROM `products`';
        try{
            $stmt = $conn->query($selectQuery);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        if (!empty($data)) {
            foreach ($data as $row) {
                if ($row["name"] == $name) {

                  return false;
                }
            }
        }
        return true;
    }

    function get_info(){

        $conn = $this->db_conn();
        $selectQuery = "SELECT * FROM `products` where display = 'yes'";
        try{
            $stmt = $conn->query($selectQuery);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;

        if(!empty($data)){
            return $data;
        }
        return "";
    }

    function get_a_product($name){

        $conn = $this->db_conn();
        $selectQuery = "SELECT * FROM `products` where name = ?";
    
        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([$name]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn = null;

        if(!empty($row)){
            return $row;
        }
        return "";
    }

    
    function update_product($data){

        $conn = $this->db_conn();
        $selectQuery = "UPDATE products set name = ?, buying_price = ?, selling_price = ?, display = ? where name = ?";
        try{
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([
                $data['new_name'], $data['buying_price'], $data['selling_price'], $data['display'],$data['name']
            ]);
        }catch(PDOException $e){
            echo "Update ".$e->getMessage();
        }
        $conn = null;
        return "Information changed!";
    }

    function searchProduct($key){
        $conn = $this->db_conn();
        $selectQuery = "SELECT * FROM `products` WHERE name LIKE '%$key%'";
    
        
        try{
            $stmt = $conn->query($selectQuery);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }


    function delete_product($name){
        $conn = $this->db_conn();
        $selectQuery = "DELETE FROM `products` WHERE `name` = ?";
        try{
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([$name]);
        }catch(PDOException $e){
            echo "Delete products ".$e->getMessage();
        }
        $conn = null;
       }
   }
?>