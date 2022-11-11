<?php
//И ещё допили вывод категорий, если дата больше 1 недели, то Категорий поста меняется Хз на чо, сам думай
//Доработка пагинации: создать переменную в которую будешь передавать $_GET и уже эту переменную передавать в ссылку
//Потому что для Категорий дефолтная пагинация не работает
    include __DIR__ . "/app/controllers/topics.php";
    include __DIR__ . '/app/include/path.php';

    //Пагинация
    $page = isset($_GET['page']) ? $_GET['page']: 1;
    $limit = 5;
    $offset = $limit * ($page - 1);
    $total_pages = round((countRow('posts') / $limit), 0);
//    test($total_pages);
    $posts = selectAllFromPostsWithUsersOnIndex('posts', 'user', $limit, $offset);
    $TopPosts = selectAll('posts', ['topic_id' => 18, 'status' => 1]);
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

<!-- блок карусели START-->
<div class="container">
    <div class="row">
        <h2 class="slider-title">Топ публикации</h2>
    </div>
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php foreach($TopPosts as $key => $TopPost): ?>
                <?php if($key == 0): ?>
                    <div class="carousel-item active">
                <?php else: ?>
                    <div class="carousel-item">
                <?php endif; ?>
                        <img src="<?="assets/images/posts/" . $TopPost['img']; ?>" alt="<?=$TopPost['title'] ?>" class="d-block w-100">
                        <div class="carousel-caption-hack carousel-caption d-none d-md-block">
                            <h5><a href="<?=BASE_URL . "single.php?post=" . $TopPost['id']; ?>"><?=$TopPost['title']; ?></a></h5>
                        </div>
                    </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"  data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"  data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- блок карусели END-->

<!-- блок main-->
<div class="container">
    <div class="content row">
        <!-- Main Content -->
        <div class="main-content col-md-9 col-12">
            <h2>Последние публикации</h2>
            <?php foreach($posts as $post): ?>
                <div class="post row">
                    <div class="img col-12 col-md-4">
                        <img src="<?= "assets/images/posts/" . $post['img']; ?>" alt="<?=$post['title']; ?>" class="img-thumbnail">
                    </div>
                    <div class="post_text col-12 col-md-8">
                        <h3>
                            <a href="<?=BASE_URL . 'single.php?post=' . $post['id'];?>"><?=substr($post['title'], 0, 80) . ' ...';  ?></a>
                        </h3>
                        <i class="far fa-user"> <?=$post['username']; ?></i>
                        <i class="far fa-calendar"> <?=$post['create_data']; ?></i>
                        <p class="preview-text">
                            <?=mb_substr($post['content'], 0, 50, 'UTF-8') . ' ...';  ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- sidebar Content -->
        <?php include __DIR__ . "/app/include/sidebar.php" ?>
        <!-- Sidebar end -->

    </div>

</div>

<!--Блок пагинации-->
<?php include __DIR__ . "/app/include/pagination.php" ?>

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