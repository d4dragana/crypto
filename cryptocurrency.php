<?php
include_once "header.php";
include_once "database.php";

$id = (int) $_GET['id'];

$query = "SELECT * FROM cryptocurrencies WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id]);

if ($stmt->rowCount() != 1){
    header("Location:index.php");
    die();
}

$crypto = $stmt->fetch();

?>

<a href="cryptocurrencies_delete.php?id=<?php echo $crypto['id'];?>" class="btn btn-primary"
    onclick="return confirm('Prepričani?')">Izbriši</a>

<a href="cryptocurrencies_edit.php?id=<?php echo $crypto['id'];?>" class="btn btn-primary">Uredi</a>

<section class="masthead bg-primary text-white text-center">

    <div class="container d-flex align-items-center flex-column">
        <!-- Masthead Avatar Image-->
        <img class="masthead-avatar mb-5" src="<?php echo $crypto['logo'];?>" alt="" />
        <!-- Masthead Heading-->
        <h1 class="masthead-heading text-uppercase mb-0"><?php echo $crypto['title'];?></h1>
        <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- Masthead Subheading-->
        <p class="masthead-subheading font-weight-light mb-0"><?php echo $crypto['description'];?></p>
    </div>
</section>

<?php
include_once "footer.php";
?>