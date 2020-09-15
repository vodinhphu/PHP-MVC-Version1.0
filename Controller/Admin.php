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