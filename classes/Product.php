<?php
class Product extends Db {
    //Fix input with escape characters
    function escape($value)
    {
        $search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
        $replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");

        return str_replace($search, $replace, $value);
    }
    //Get it all!
    public function select(){
        $sql = "SELECT * FROM products";
        $result = $this->connect()->query($sql);
        if($result->rowCount() > 0){
            while($row = $result->fetch()){
                $data[] = $row;
            }
            return $data;
        }
    }
    //Get it all!
    public function search_all($input){
        $input = $this->escape($input);
        $sql = "SELECT id, plu, description, qty, price, category, picture, datasheet FROM products
        WHERE description LIKE '%$input%' OR category LIKE '%$input%' OR price LIKE '%$input%' 
        OR plu LIKE '%$input%'";
        $result = $this->connect()->query($sql); //Look for result of entire term
        while($row = $result->fetch()){
            $data[] = $row;
        }
        $sep_input = explode(" ", $input);
        foreach($sep_input as $piece){
            $sql = "SELECT id, plu, description, qty, price, category, picture, datasheet FROM products
            WHERE description LIKE '%$piece%' OR category LIKE '%$piece%'";
            $result = $this->connect()->query($sql); //Then look for individual terms results
            while($row = $result->fetch()){
                $data[] = $row;
            }
            if($result->rowCount() > 0){
                $data = array_intersect_key($data, array_unique(array_map('serialize', $data))); //Remove Duplicate Values in the Array
                return $data;
            }
        }
    }
    //Get from id
    public function search_id($input){
        $input = $this->escape($input);
        $sql = "SELECT * FROM products WHERE id='$input'";
        $result = $this->connect()->query($sql);
        if($result->rowCount() > 0){
            while($row = $result->fetch()){
                $data[] = $row;
            }
            return $data;
        }
    }
    //Get it from name!
    public function search_name($input){
        $input = $this->escape($input);
        $sql = "SELECT id, plu, description, qty, price, category, picture, datasheet FROM products
        WHERE description LIKE '%$input%' OR category LIKE '%$input%'";
        $result = $this->connect()->query($sql); //Look for entire term results 
        while($row = $result->fetch()){
            $data[] = $row;
        }
        $sep_input = explode(" ", $input);
        foreach($sep_input as $piece){
            $sql = "SELECT id, plu, description, qty, price, category, picture, datasheet FROM products
            WHERE description LIKE '%$piece%' OR category LIKE '%$piece%'";
            $result = $this->connect()->query($sql); //Then look for individual terms results
            if($result->rowCount() > 0){
                while($row = $result->fetch()){
                    $data[] = $row;
                }
            }
        }
        if($result->rowCount() > 0){
            $data = array_intersect_key($data, array_unique(array_map('serialize', $data))); //Remove Duplicate Values in the Array
            return $data;
        }
    }
    //Get from PLU!
    public function search_plu($input){
        $input = $this->escape($input);
        $sql = "SELECT id, plu, description, qty, price, category, picture, datasheet FROM products
        WHERE plu LIKE '%$input%'";
        $result = $this->connect()->query($sql);
        if($result->rowCount() > 0){
            while($row = $result->fetch()){
                $data[] = $row;
            }
            return $data;
        }
    }
    //Get from price!
    public function search_price($input){
        $input = $this->escape($input);
        $sql = "SELECT id, plu, description, qty, price, category, picture, datasheet FROM products
        WHERE price LIKE '%$input%'";
        $result = $this->connect()->query($sql);
        if($result->rowCount() > 0){
            while($row = $result->fetch()){
                $data[] = $row;
            }
            return $data;
        }
    }
    //Get all categories!
    public function get_categories(){
        $sql = "SELECT DISTINCT category FROM products";
        $result = $this->connect()->query($sql);
        if($result->rowCount() > 0){
            while($row = $result->fetch()){
                $data[] = $row;
            }
            return $data;
        }
    }
    //Get all datasheets!
    public function get_datasheets(){
        $sql = "SELECT DISTINCT datasheet FROM products";
        $result = $this->connect()->query($sql);
        if($result->rowCount() > 0){
            while($row = $result->fetch()){
                $data[] = $row;
            }
            return $data;
        }
    }
    //Get all pictures!
    public function get_pictures(){
        $sql = "SELECT DISTINCT picture FROM products";
        $result = $this->connect()->query($sql);
        if($result->rowCount() > 0){
            while($row = $result->fetch()){
                $data[] = $row;
            }
            return $data;
        }
    }
    //Get top sellers!
    public function get_most_sold(){
        $sql = "SELECT * FROM products ORDER BY sold DESC";
        $result = $this->connect()->query($sql);
        if($result->rowCount() > 0){
            while($row = $result->fetch()){
                $data[] = $row;
            }
            return $data;
        }
    }
    //Update a product
    public function update($id, $plu, $description, $qty, $price, $category, $picture, $datasheet){
        $sql = "UPDATE products SET plu='$plu', description='$description', qty='$qty', 
        price='$price', category='$category', picture='$picture', datasheet='$datasheet' 
        WHERE id='$id'"; 
        $this->connect()->query($sql);
    }
    //Update a product based on POS report
    public function update_sync($id, $qty, $sold){
        $sql = "UPDATE products SET qty='$qty', sold='$sold' WHERE id='$id'"; 
        $this->connect()->query($sql);
    }
    //Delete Item
    public function delete($id){
        $sql = "DELETE FROM products WHERE id='$id'";
        $this->connect()->query($sql);
    }
    //Add New Item
    public function add($plu, $description, $qty, $price, $category, $picture, $datasheet){
        $sold = 0;
        $sql = "INSERT INTO products (plu, description, qty, price, category, picture, datasheet, sold)
        VALUES ('$plu', '$description', '$qty', '$price', '$category', '$picture', '$datasheet', '$sold')";
        $this->connect()->query($sql);
    }
    //Change from pural to singular
    public function pural_check($input){
        if(strlen($input) > 3){
            if(substr($input, -1) == 's'){
                if(substr($input, -2, 1) == 'e'){
                    if(substr($input, -3, 1) == 'i'){
                        return substr($input,0,-3);
                    }
                    else{
                        return substr($input,0,-2);
                    }
                }
                else{
                    return substr($input, 0, -1);
                }
            }
            else{
                return $input;
            }
        }
        return $input;
    }
}
?>