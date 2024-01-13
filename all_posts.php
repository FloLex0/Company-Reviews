<?php

include 'components/connect.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>all companies</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/header.php'; ?>
<!-- header section ends -->

<!-- view all posts section starts  -->

<section class="all-posts">

   <div class="heading"><h1>all companies</h1></div>
   <div class="heading search_bar">
   <div class="row height d-flex  ">

<div class="col-md-6">

  <div class="form">
    <i class="fa fa-search"></i>
    <input type="text" class="form-control form-input" placeholder="Seach Company..." id="getName"/>
    
  </div>
  
</div>
</div>

</div>
<div class="box-container">
<div id="showdata" class="showelements">
<?php


$sql = $conn->prepare ("SELECT * FROM posts limit 12");
$sql->execute();

while($fetch_post = $sql->fetch(PDO::FETCH_ASSOC))
{
   $post_id = $fetch_post['id'];
   $count_reviews = $conn->prepare("SELECT * FROM `reviews` WHERE post_id = ?");
   $count_reviews->execute([$post_id]);
   $total_reviews = $count_reviews->rowCount();

 
?>
   <div class="box datashow"  >
   
   <h3 class="title"><?= $fetch_post['title']; ?></h3>
   <p class="total-reviews"><i class="fas fa-star"></i> <span><?= $total_reviews; ?></span></p>
   <a href="view_post.php?get_id=<?= $post_id; ?>" class="inline-btn button-view-company">View Company</a>
</div>
<?php
}
?>
</section>

<!-- view all posts section ends -->

</section>

<!-- view all posts section ends -->

<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<?php include 'components/alers.php'; ?>

</body>
</html>

<style>
.all-posts .box-container {
display: grid;
}

.all-posts .box-container .box .total-reviews{
   padding-bottom:0;
}

.all-posts .box-container .box {
   height: -webkit-fill-available;
}

.button-view-company{
   font-size: larger;
   margin-top:0;
}
.all-posts .box-container .box .title {
    font-size: 15px;
    text-transform:uppercase;
}

.search_bar{
   justify-content: center;
}

.form{

position: relative;
}

.form .fa-search{

position: absolute;
top:22px;
left: 20px;
color: #9ca3af;

}

.form span{

    position: absolute;
right: 17px;
top: 20px;
padding: 2px;
border-left: 1px solid #d1d5db;

}

.left-pan{
padding-left: 7px;
}

.left-pan i{

padding-left: 10px;
}

.form-input{

height: 55px;
text-indent: 33px;
border-radius: 10px;
width:500px;
}



.showelements{
   display:contents;
   text-align:center;
}
</style>

<script>
  $(document).ready(function(){
   $('#getName').on("keyup", function(){
     var getName = $(this).val();
     $.ajax({
       method:'POST',
       url:'searchajax.php',
       data:{name:getName},
       success:function(response)
       {
            $("#showdata").html(response);
       } 
     });
   });
  });
</script>


