<?php 

ob_start();

class Config
{
	private $con;
	public $cDateTime;

	function __construct()
	{
		session_start();
		$this->connect();		
		$this->setVar();
	}
	
	public function setVar()
	{
		date_default_timezone_set("Asia/Kolkata");
		$this->cDateTime=date("Y-m-d h:i:s");
	}

	//To Connect With Database
	private function connect()
	{
		$HOSTNAME="localhost";
		$USERNAME="root";
		$PASSWORD="";
		$DBNAME="newproperty365_db";

		$this->con=mysqli_connect($HOSTNAME,$USERNAME,$PASSWORD,$DBNAME);

		if(!$this->con)
		{
			echo "Not Connected.";
		}
	}

	// Close Connection
	function __destruct()
	{
		mysqli_close($this->con);
	}

	// Print Array

	public function printArray($array)
	{
		echo "<pre>";
		print_r($array);
		echo "</pre>";
	}


	// Modify or Select Data
	public function myQuery($query)
	{
		return $this->con->query($query);
	}

	// To insert data
	public function myInsert($tblName,$data)
	{
		$fieldVal="";

		foreach ($data as $fieldName => $value) {
			$fieldVal.=$fieldName."="."'$value',";
		}

		$fieldVal=trim($fieldVal,",");	

		 $query="INSERT INTO $tblName SET $fieldVal";
		 // echo $query;
		 return $this->con->query($query);

	}

	// To update data
	public function myUpdate($tblName,$data,$wh=null,$op="AND")
	{
		$fieldVal="";

		foreach ($data as $fieldName => $value) {
			$fieldVal.=$fieldName."="."'$value',";
		}

		$fieldVal=trim($fieldVal,",");

		$where="";
		if($wh!=null){
			$where.=" WHERE ";
			foreach ($wh as $fieldName => $value) {
				$where.=$fieldName."="."'$value' ".$op." ";
			}

			$where=trim($where," $op");
		}	

		  $query="UPDATE $tblName SET $fieldVal  $where";
		 return $this->con->query($query);
	}

	// To delete data
	public function myDelete($tbl_name,$wh,$op="AND")
	{
		$WHERE="WHERE ";
		foreach ($wh as $key => $value) {
			$WHERE.="`$key`='$value' $op ";
		}
		$WHERE=trim($WHERE," $op");
		$query="DELETE FROM  `$tbl_name` $WHERE";
		return $this->con->query($query);
	}

	
	// To redirect any page
	public function redirect($pageName)
	{
		header("Location:$pageName");
	}

	// To convert time from date to actual time
	public function convertTime($originalTime)
	{
		echo date('d-m-Y h:i:s',strtotime($originalTime));
	}

	// To show array properly
	public function showArray($array)
	{
		echo "<pre>";
		print_r($array);
		echo "</pre>";
	}

}
