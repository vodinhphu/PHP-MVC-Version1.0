<?php

class Game
{
	public  $model, $action;
	public $dataCat, $dataPub;
	function __construct()
	{
		$this->model = new Model_Game();
		$action = getIndex('action', 'index');
		$this->dataCat= $this->model->getCat();
		$this->dataPub = $this->model->getPub();
		//print_r($_GET);
		if (method_exists($this,$action))
			$this->$action();
		else {echo "Chua xd function {$this->action} "; exit;}
		
	}

/**
 * [index description]
 * @return [type] [description]
 */
function index()
	{
		$data = $this->model->getnGame(5);
		$data_cat = $this->dataCat;// $this->model->getCat();
		$data_pub = $this->dataPub;//$this->model->getPub();
		$subview = 'game_index.php';
		include "View/trangchu.php";
	}
function cart()
{

    $database_name = "gamestore";
    $con = mysqli_connect("localhost","root","",$database_name);

    if (isset($_POST["add"])){
        if (isset($_SESSION["cart"])){
            $item_array_id = array_column($_SESSION["cart"],"product_id");
            if (!in_array($_GET["id"],$item_array_id)){
                $count = count($_SESSION["cart"]);
                $item_array = array(
                    'product_id' => $_GET["id"],
                    'item_name' => $_POST["hidden_name"],
                    'product_price' => $_POST["hidden_price"],
                    'item_quantity' => $_POST["quantity"],
                );
                $_SESSION["cart"][$count] = $item_array;
                echo '<script>window.location="index.php?controller=Game&action=cart"</script>';
            }else{
                echo '<script>alert("Product is already Added to Cart")</script>';
                echo '<script>window.location="index.php?controller=Game&action=cart"</script>';
            }
        }else{
            $item_array = array(
                'product_id' => $_GET["id"],
                'item_name' => $_POST["hidden_name"],
                'product_price' => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"],
            );
            $_SESSION["cart"][0] = $item_array;
        }
    }

    if (isset($_GET["action2"])){
        if ($_GET["action2"] == "delete"){
            foreach ($_SESSION["cart"] as $keys => $value){
                if ($value["product_id"] == $_GET["id"]){
                    unset($_SESSION["cart"][$keys]);
                    echo '<script>alert("Product has been Removed...!")</script>';
                    echo '<script>window.location="index.php?controller=Game&action=cart"</script>';
                }
            }
        }
    }
    $data = $this->model->getnGame(5);
		$data_cat = $this->dataCat;// $this->model->getCat();
		$data_pub = $this->dataPub;//$this->model->getPub();
		$subview = 'game_index.php';
		include "View/trangchu.php";
}
function bookCat()
{
	$cat_id = getIndex('cat_id');
	$data = $this->model->selectQuery("select * from book where cat_id= ?", array($cat_id));
	$data_cat = $this->dataCat;
		$data_pub = $this->dataPub;
		$subview = 'book_cat.php';
		include "View/layout1.php";

}
function show()
	{
		$data = $this->model->getBook();
		include "View/view.php";
	}

	function filter()
	{
		$name= getIndex('book_name');
		$cat_id= getIndex('cat_id','all');
		$pub_id = getIndex('pub_id', 'all');
		$data =$this->model->filter($name, $cat_id='all', $pub_id='all');
		include "View/view.php";
	}

	function detail()
	{
		//print_r($_GET);exit;
		$product_id=getIndex('id');
		if ($product_id !='')
		{
			$data =$this->model->detail($product_id);
			
		}

		$data_cat = $this->dataCat;
		$data_pub = $this->dataPub;
		$subview = 'product_detail.php';
		include "View/trangchu.php";
	}

	function update()
	{
		$arr= array();
		//$book_id = 
	}

	function insert()
	{

		$_SESSION['info']='';
		$arr = array();
		$arr[] = postIndex('pro_name');
		/*if ($this->EXISTS_ID('book', 'book_id', $arr['book_id'] ))
		{
			return -1;//da co book_id trong table sach
		}*/

		$arr[] 	= postIndex('price');
		$arr[] = postIndex('producer');
		$arr[] 		= postIndex('quantity_available');
		$arr[] 		= postIndex('details');
		$sql="insert into game(pro_name, price, producer, quantity_available, details ";
		if ($_FILES['img']['error'] ==0)
		{
			move_uploaded_file($_FILES['img']['tmp_name'], UPLOAD_IMG .$_FILES['img']['name']);
			$arr[] 		= $_FILES['img']['name'];
			$sql .=", image ";
		}

		$sql .=")";
		
		if (Count($arr)==6)
		$sql .=" values(?, ?, ?, ?, ?, ?)";
		else
		$sql .=" values(?, ?, ?, ?, ?, ?, ?)";
		$n= $this->model->updateQuery($sql, $arr);
		if ($n==1)
		{
			$_SESSION['info']="Đã thêm  ". $arr[0];
			header('location:index.php?controller=Admin');
			exit;
		}
		else
			{
			$_SESSION['info']="Lỗi thêm... ". $arr[0];

	
		}

	}

	function frmsearch()
	{
		$data_cat = $this->dataCat;
		$data_pub = $this->dataPub;
		$subview = 'book_frmsearch.php';
		include "View/layout1.php";
	}

	function search()
	{
		$key = getIndex('key');
		$data = $this->model->filter($key);
		echo "<pre>";print_r($data); 
	}

	function search2()
	{
		$key = postIndex('key');
		$data = $this->model->filter($key);
		echo "<pre>";print_r($data); 
	}

	function search3()
	{
		echo "Tim kiem bang Ajax<hr>";
		$kw = getIndex("n");
		if ($kw=="") {
			# code...
		} else{
			$data = $this->model->filter($kw);
		foreach ($data as $key => $value) {
		?>
		<div><?php echo $value['book_id'] ?>-<?php echo $value['book_name'] ?></div>
		<?php
		}
		
		}
		
	}	
	
}