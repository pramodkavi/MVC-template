<?php

// Main Model trait

Trait Model {

    use Database;
    
    // protected $table = '';
    protected $limit =10;
    protected $offset = 0;
    public $errors =  [];

    public function findAll(){
        
        $query = "select * from $this->table limit $this->limit offset $this->offset"; 
        
        // make the query
        return $this->query($query);

    }

    public function where($data , $data_not=[]){
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "select * from $this->table where ";
        
        foreach ($keys as $key){
            $query .= $key . "= :" . $key . " && ";
        }
        foreach ($keys_not as $key){
            $query .= $key . "!= :" . $key . " && ";
        }

        $query = trim($query, " && ");
        $query .= " limit $this->limit offset $this->offset"; // make the query

        $data = array_merge($data,$data_not); // mearge data arrays to put the query function as parameter
        
        return $this->query($query,$data);

    }

    public function first($data , $data_not=[]){

        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "select * from $this->table where ";
        
        foreach ($keys as $key){
            $query .= $key . "= :" . $key . " && ";
        }
        foreach ($keys_not as $key){
            $query .= $key . "!= :" . $key . " && ";
        }

        $query = trim($query, " && ");
        $query .= " limit $this->limit offset $this->offset"; // make the query

        $data = array_merge($data,$data_not); // mearge data arrays to put the query function as parameter
        
        $result = $this->query($query,$data);

        if($result){
            return $result[0];
        } 
        return false;

    }

    public function insert($data){

        $keys = array_keys($data);

        $query = "insert into $this->table (".implode(",",$keys).") values (:".implode(",:" , $keys).")";
        
        $this->query($query,$data);

        return false;

    }
    public function delete($id, $id_column = "id"){
        
        $data[$id_column] = $id;
        $query = "delete from $this->table where $id_column = :$id_column";

        $this->query($query,$data);
        return false;
    }

    public function update($id ,$data,$id_column="id"){

        $keys = array_keys($data);
        $query = "Update $this->table set ";

        foreach($keys as $key){
            $query .= $key." = :".$key.",";
        }

        $query = trim($query,',');
        $query.= " where $id_column =:$id_column ";

        // echo $query;

        $data[$id_column] = $id;

        $this->query($query,$data);
        return false;
    }


}

