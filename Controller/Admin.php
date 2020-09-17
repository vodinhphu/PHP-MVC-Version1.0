<?php
class Admin
{
	public $model;
	function __construct()
	{
		if (!isset($_SESSION['admin_login']))
		{
			$_SESSION['flash']="Khong duoc phep truy cap...";

			//header('location:login.html');
			echo "Không được phép truy cập! ";
			echo "<a href=index.php?controller=Login&action=index>Đăng nhập</a>";
			exit;
		}
		$this->model = new Model_Game();
		$action = getIndex('action', 'index');
		$this->dataCat= $this->model->getCat();
		$this->dataPub = $this->model->getPub();
		//print_r($_GET);
		if (method_exists($this,$action))
			$this->$action();
		else {echo "Chua xd function {$this->action} "; exit;}
	}

	function index()
	{
		$this->model= new Model_Game();
		$data = $this->model->getGame();
		$admin_sub_view='admin_index.php';
		include ROOT ."/View/admin_layout1.php";
	}
	function import()
	{
		$this->model= new Model_Game();
		$data = $this->model->getGame();
		include ROOT ."/View/subview/import.php";
	}
	function postImport()
	{
		$conn = new \mysqli('localhost', 'root', '', 'gamestore');
		if (mysqli_connect_errno()) {
            trigger_error("Problem with connecting to database.");
        }

        $conn->set_charset("utf8");

		$this->model= new Model_Game();
		$db = $this->model;
		$data = $this->model->getGame();
		if (isset($_POST["import"])) {
		    
		    $fileName = $_FILES["file"]["tmp_name"];
		    
		    if ($_FILES["file"]["size"] > 0) {
		        
		        $file = fopen($fileName, "r");
		        $key = 1;
		        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
		        	$key++;
		        	if(count($column) < 5){
		        		var_dump($column);
		            	break;
		        	}
		            $product_id = "";
		            if (isset($column[0])) {
		                $product_id = mysqli_real_escape_string($conn, $column[0]);
		            }
		            $pro_name = "";
		            if (isset($column[1])) {
		                $pro_name = mysqli_real_escape_string($conn, $column[1]);
		            }
		            $price = "";
		            if (isset($column[2])) {
		                $price = mysqli_real_escape_string($conn, $column[2]);
		            }
		            $image = "";
		            if (isset($column[3])) {
		                $image = mysqli_real_escape_string($conn, $column[3]);
		            }
		            $producer = "";
		            if (isset($column[4])) {
		                $producer = mysqli_real_escape_string($conn, $column[4]);
		            }
		            $quantity_available = "";
		            if (isset($column[5])) {
		                $quantity_available = mysqli_real_escape_string($conn, $column[5]);
		            }
		            $details = "";
		            if (isset($column[6])) {
		                $details = mysqli_real_escape_string($conn, $column[6]);
		            }
		            
		            $sqlInsert = "INSERT into game (product_id,pro_name,price,image,producer,quantity_available,details)
		                   values (?,?,?,?,?,?,?)";
		            $paramType = "isissis";
		            $paramArray = array(
		                $product_id,
		                $pro_name,
		                $price,
		                $image,
		                $producer,
		                $quantity_available,
		                $details
		            );
		            
		            $insertId = $db->insertPro($sqlInsert, $paramType, $paramArray);
			        
		            
		            if (! empty($insertId)) {
		                $type = "success";
		                $_SESSION['success'] = 'success';
		                $message = "CSV Data Imported into the Database";
		            } else {
		                $type = "error";
		                $message = "Problem in Importing CSV Data";
		            }
		        }
		    }
		}
		header("Location: http://localhost/PHP-MVC/index.php?controller=Admin&action=import");
		die();
		// include ROOT ."/View/subview/import.php";
	}
	function deletebook()
	{
		$book_id= getIndex('book_id');
		$this->model = new Model_Book();
		$n = $this->model->delete($book_id);
	}

	function edit()
	{
		$book_id=getIndex('book_id');
		$data = $this->model->detail($book_id);
		$data_cat = $this->model->getCat();
		$data_pub = $this->model->getPub();
		$admin_sub_view='admin_edit.php';
		include ROOT ."/View/admin_layout1.php";
	}

	function listBook()
	{
		
	}

	function updateBook()
	{
		$this->model->update();
	}
}