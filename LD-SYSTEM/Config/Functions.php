<?php

class Functions{

    private $DBHOST = 'localhost';
    private $DBUSER = 'root';
    private $DBPASS = '';
    private $DBNAME = 'data';
    public $conn;

    public function __construct(){
        try{
            $this->conn = mysqli_connect($this->DBHOST, $this->DBUSER, $this->DBPASS, $this->DBNAME);
            if(!$this->conn){  
                throw new Exception('Connection was Not Extablish');
            }
        }
        catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
            
        }

    }

    public function validate($string){
        $string_vali = mysqli_real_escape_string($this->conn, trim(strip_tags($string)));
        return $string_vali;
    }

    public function user_verify($tb_name, $condition, $op="AND"){

		$field_data = "";
		foreach($condition as $d_key => $d_value){
			$field_data .= "$d_key='$d_value' $op ";
        }
        
        $field_data = rtrim($field_data,"$op ");
        
		$select = "SELECT * FROM $tb_name WHERE $field_data";
		$select_fire = mysqli_query($this->conn, $select);
		if(mysqli_num_rows($select_fire) == 1){
			return true;
		}
		else{
			return false;
		}

    }

    public function insert($tb_name, $tb_field){
       
        $q_data = "";

        foreach($tb_field as $q_key => $q_value){
            $q_data = $q_data."$q_key='$q_value',";
        }
        $q_data = rtrim($q_data,",");

        $query = "INSERT INTO $tb_name SET $q_data";
        $insert_fire = mysqli_query($this->conn, $query);
        if($insert_fire){
            return $insert_fire;
        }
        else{
            return false;
        }

    }

    public function select_order($tbl_name, $field_id, $order='ASC'){

        $select = "SELECT * FROM $tbl_name ORDER BY $field_id $order";
        $query = mysqli_query($this->conn, $select);
        if(mysqli_num_rows($query) > 0){
            $select_fetch = mysqli_fetch_all($query, MYSQLI_ASSOC);
            if($select_fetch){
                return $select_fetch;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }

    }

    public function update($tbl_name, $tb_field, $condition, $op='AND'){

        $u_data = "";

        foreach($tb_field as $qq_key => $qq_value){
            $u_data = $u_data."$qq_key='$qq_value',";
        }
        $u_data = rtrim($u_data,",");        
        
        $up_data = "";

		foreach ($condition as $q_key => $q_value) {
			$up_data = $up_data."$q_key='$q_value' $op ";
		}
        $up_data = rtrim($up_data,"$op ");

        $query = "UPDATE $tbl_name SET $u_data WHERE $up_data";
        $query_fire = mysqli_query($this->conn, $query);
        if($query_fire){
            return $query_fire;
        }
        else{
            return false;
        }

    }

    public function delete($tbl_name, $condition, $op='AND'){

        $de_data = "";

		foreach ($condition as $q_key => $q_value) {
			$de_data = $de_data."$q_key='$q_value' $op ";
		}
        $de_data = rtrim($de_data,"$op ");

		$delete = "DELETE FROM $tbl_name WHERE $de_data";
		$delete_fire = mysqli_query($this->conn, $delete);
		if($delete_fire){
			return $delete_fire;
		}
		else{
			return false;
        }
        
    }
	public function select_assoc($tbl_name, $condition, $op='AND'){

		$field_op = "";
		foreach ($condition as $q_key => $q_value) {
			$field_op = $field_op."$q_key='$q_value' $op ";
		}
		$field_op = rtrim($field_op,"$op ");

        $select_assoc = "SELECT * FROM $tbl_name WHERE $field_op";

		$select_assoc_query = mysqli_query($this->conn, $select_assoc);
		if(mysqli_num_rows($select_assoc_query) == 1){	

			$select_assoc_fire = mysqli_fetch_assoc($select_assoc_query);
			if($select_assoc_fire){
				return $select_assoc_fire;
			}
			else{
				return false;
            }
            
		}
		else{	
			return false;
		}

    }    
    
    public function select_count($tbl_name, $condition, $op='AND'){

		$field_op = "";
		foreach ($condition as $q_key => $q_value) {
			$field_op = $field_op."$q_key='$q_value' $op ";
		}
		$field_op = rtrim($field_op,"$op ");
        $select_count = "SELECT COUNT(*) AS NumberOfLikeDislike FROM $tbl_name WHERE $field_op";
        $select_count_query = mysqli_query($this->conn, $select_count);
		if($select_count_query){	
            $row_cnt = mysqli_fetch_array($select_count_query, MYSQLI_ASSOC);
            return $row_cnt; 
		}
		else{	
			return false;
		}

	}  

}




?>