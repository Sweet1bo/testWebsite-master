<?php
    include __DIR__ . "/app/controllers/topics.php";
    $postId = $_GET['post'];
    $postData = selectOneFromPostWithUserOnIndex('posts', 'user', $postId);
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Custom Styling -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>My blog</title>
</head>
<body>

<!--Header connect-->
<?php include "app/include/header.php" ?>

<!-- блок main-->
<div class="container">
    <div class="content row">
        <!-- Main Content -->
        <div class="main-content col-md-9 col-12">
            <h2><?php echo $postData['title']; ?></h2>

            <div class="single_post row">
                <div class="img col-12">
                    <img src="<?= "assets/images/posts/" . $postData['img']; ?>" alt="<?=$postData['title']; ?>" class="img-thumbnail">
                </div>
                <div class="info">
                    <i class="far fa-user"> <?=$postData['username']; ?></i>
                    <i class="far fa-calendar"> <?=$postData['create_data']; ?></i>
                </div>
                <div class="single_post_text col-12">
                    <?php echo $postData['content'];?>
                </div>
                <!-- ИНКЛЮДИМ HTML БЛОК С КОММЕНТАРИЯМИ  --->

            </div>

        </div>
        <!-- sidebar Content -->
        <?php include __DIR__ . "/app/include/sidebar.php" ?>
        <!-- sidebar end -->
    </div>

    <?php include __DIR__ . "/app/include/comments.php" ?>

</div>

<!-- блок main END-->

<!-- Footer connect -->
<?php include "app/include/footer.php" ?>


<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
-->
</body>
</html>