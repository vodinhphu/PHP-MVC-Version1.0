<?php foreach ($data as $key => $value) {
  # code...
 ?>
<div class="col-sm-3">
  <div class="panel panel-default text-center">
    <div class="panel-heading">
      <img class="imgindex" src="images/products/<?php echo $value['image']?>">
    </div>
    <div class="panel-body">
      <p><strong>Name: <?php echo $value['pro_name']?></strong></p>
      <p><strong>Producer: <?php echo $value['producer']?></strong></p>
    </div>
    <div class="panel-footer">
      <h3>$<?php echo $value['price']?></h3>
      <button class="btn btn-lg"><a href='detail-<?php echo chuanHoaChuoi($value['pro_name']) ?>-<?php echo $value['product_id'] ?>.html'>Details</a></button>
    </div>
  </div>
</div>
<?php  
  }
?>