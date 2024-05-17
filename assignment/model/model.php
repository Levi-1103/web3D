<?php
class Model {
	public $dbhandle;
	
	
	public function __construct()
	{
		$dsn = 'sqlite:./db/test.db';
		try {	
			
			$this->dbhandle = new PDO($dsn, 'user', 'password', array(
    													PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    													PDO::ATTR_EMULATE_PREPARES => false,
														));
		}
		catch (PDOEXception $e) {
			echo "Unable to connect to Database";
        	print new Exception($e->getMessage());
    	}
	}
	
	public function dbCreateTable()
	{
		try {
			$this->dbhandle->exec("CREATE TABLE ModelDescription (Id INTEGER PRIMARY KEY, brand TEXT, modelTitle TEXT, modelSubtitle TEXT, modelDescription TEXT)");
			return "Model_3D table is successfully created inside test.db file";
		}
		catch (PD0EXception $e){
			print new Exception($e->getMessage());
		}
		$this->dbhandle = NULL;
	}

	public function dbInsertData()
	{
		try{
			$this->dbhandle->exec(
			"INSERT INTO ModelDescription (Id, brand, modelTitle, modelSubtitle, modelDescription) 
				VALUES (1, 'Coke', 'Coca Cola Can Model', 'Model made in Blender', 'This is a model of a Coke can.'); " .
			"INSERT INTO ModelDescription (Id, brand, modelTitle, modelSubtitle, modelDescription) 
				VALUES (2, 'Sprite', 'Sprite Bottle Model', 'Model made in Blender', 'This is a model of a Sprite bottle.'); " .
			"INSERT INTO ModelDescription (Id, brand, modelTitle, modelSubtitle, modelDescription) 
				VALUES (3, 'DrPepper', 'Dr. Pepper Bottle Model', 'Model made in Blender', 'This is a model of a Dr. Pepper bottle.');");
			return "Data inserted into test.db";
		}
		catch(PD0EXception $e) {
			print new Exception($e->getMessage());
		}
		$this->dbhandle = NULL;
	}

	public function dbGetData(){
		try{
			
			$sql = 'SELECT * FROM ModelDescription';
			
			$stmt = $this->dbhandle->query($sql);
			
			$result = null;
			
			$i=-0;
		
			while ($data = $stmt->fetch()) {
			
				$result[$i]['brand'] = $data['brand'];
				$result[$i]['modelTitle'] = $data['modelTitle'];
				$result[$i]['modelSubtitle'] = $data['modelSubtitle'];
				$result[$i]['modelDescription'] = $data['modelDescription'];
				$i++;
			}
		}
		catch (PD0EXception $e) {
			print new Exception($e->getMessage());
		}
		$this->dbhandle = NULL;
		return $result;
	}

}
?>