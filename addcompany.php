<?php

include 'components/connect.php';

if(isset($_POST['submit'])){

   $id = create_unique_id();
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $vatnumber = $_POST['vatnumber'];
   $vatnumber = filter_var($vatnumber, FILTER_SANITIZE_STRING);
   $adresscompany = $_POST['adresscompany'];
   $adresscompany = filter_var($adresscompany, FILTER_SANITIZE_STRING);

   $verify_vatnumber = $conn->prepare("SELECT * FROM `posts` WHERE cui = ?");
   $verify_vatnumber->execute([$vatnumber]);

   if($verify_vatnumber->rowCount() > 0){
      $warning_msg[] = 'VAT Number already exists!';
   }else{
         $insert_company = $conn->prepare("INSERT INTO `posts`(id, title, cui, adresa) VALUES(?,?,?,?)");
         $insert_company->execute([$id, $name, $vatnumber, $adresscompany]);
         $success_msg[] = 'Registered successfully!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register Company</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/header.php'; ?>
<!-- header section ends -->

<section class="account-form">

   <form action="" method="post" enctype="multipart/form-data" >
      <h3>Add New Company!</h3>
      <p class="placeholder">Name Company<span>*</span></p>
      <input type="text" name="name" required maxlength="50" placeholder="enter company name" class="box">
      <p class="placeholder">VAT Number <span>*</span></p>
     
      <input id="namn" pattern="[a-zA-Z]{2}\d{8}" type="text"  name="vatnumber" required minlength="6" maxlength="50" placeholder="enter vat number" class="box">

      <p class="placeholder">Adress Company<span>*</span></p>
      <input type="text" name="adresscompany" required maxlength="50" placeholder="enter adress" class="box">

      <input type="submit"  value="Add now" name="submit" class="btn">
   </form>

</section>

<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<?php include 'components/alers.php'; ?>

</body>
</html>

