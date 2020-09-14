<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Theme Company</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<style>
a{
  text-decoration: none; 
  color : #fff;
}
.jumbotron {
  /*background-color: #f4511e;*/ /* Orange */
  background-image: url('images/banner-3');
  color: #ffffff;
  height: 400px;
  padding: 100px 25px;
}
.bg-grey {
  background-color: #f6f6f6;
}
.container-fluid {
  padding: 60px 50px;
}
.logo {
  font-size: 200px;
}
@media screen and (max-width: 768px) {
  .col-sm-4 {
    text-align: center;
    margin: 25px 0;
  }
}
.panel {
  border: 1px solid #f4511e;
  border-radius:0;
  transition: box-shadow 0.5s;
}

.panel:hover {
  box-shadow: 5px 0px 40px rgba(0,0,0, .2);
}

.panel-footer .btn:hover {
  border: 1px solid #f4511e;
  background-color: #fff !important;
  color: #f4511e;
}

.panel-heading {
  color: #fff !important;
 /* background-color: #f4511e !important;*/
  padding: 25px;
  border-bottom: 1px solid transparent;
  border-top-left-radius: 0px;
  border-top-right-radius: 0px;
  border-bottom-left-radius: 0px;
  border-bottom-right-radius: 0px;
  overflow: hidden;
}

.panel-footer {
  background-color: #fff !important;
}

.panel-footer h3 {
  font-size: 32px;
}

.panel-footer h4 {
  color: #aaa;
  font-size: 14px;
}

.panel-footer .btn {
  margin: 15px 0;
  background-color: #f4511e;
  color: #fff;
}
.imgindex {
  width: 100%;
  height: 300px;
}
.panel-default>.panel-heading{
  padding: 0px;
}
.panel-footer h3{
  margin:0;
}
</style>
<body>

<div class="jumbotron text-center ">
  <h1>SMARTOSC GAME STORE</h1>
  <p>The biggest online Game store</p>
</div>
<div class="container-fluid">
  <div class="text-center">
    <h2>GAME</h2>
    <h4>Choose a game for you</h4>
  </div>
  <div class="row">
   <?php include ROOT . "/View/subview/$subview" ;?>
  </div>
</div>

</body>
</html>