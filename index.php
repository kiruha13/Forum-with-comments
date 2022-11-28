<?php
$con = mysqli_connect('localhost', 'root', 'mypass', 'notes2');

if (isset($_POST['liked'])) {
    $postid = $_POST['postid'];
    $result = mysqli_query($con, "SELECT * FROM posts WHERE id=$postid");
    $row = mysqli_fetch_array($result);
    $n = $row['likes'];

    mysqli_query($con, "INSERT INTO likes (userid, postid) VALUES (1, $postid)");
    mysqli_query($con, "UPDATE posts SET likes=$n+1 WHERE id=$postid");

    echo $n+1;
    exit();
}
if (isset($_POST['unliked'])) {
    $postid = $_POST['postid'];
    $result = mysqli_query($con, "SELECT * FROM posts WHERE id=$postid");
    $row = mysqli_fetch_array($result);
    $n = $row['likes'];

    mysqli_query($con, "DELETE FROM likes WHERE postid=$postid AND userid=1");
    mysqli_query($con, "UPDATE posts SET likes=$n-1 WHERE id=$postid");

    echo $n-1;
    exit();
}
if (isset($_GET['pageno'])) {
    // Если да то переменной $pageno присваиваем его
    $pageno = $_GET['pageno'];
} else { // Иначе
    // Присваиваем $pageno один
    $pageno = 1;
}

// Назначаем количество данных на одной странице
$size_page = 5;
// Вычисляем с какого объекта начать выводить
$offset = ($pageno-1) * $size_page;


$count_sql = "SELECT COUNT(*) FROM `posts`";
// Отправляем запрос для получения количества элементов
$result = mysqli_query($con, $count_sql);
// Получаем результат
$total_rows = mysqli_fetch_array($result)[0];
// Вычисляем количество страниц
$total_pages = ceil($total_rows / $size_page);

// Создаём SQL запрос для получения данных
$sql = "SELECT * FROM `posts` ORDER BY id DESC LIMIT $offset, $size_page";
// Отправляем SQL запрос
$res_data = mysqli_query($con, $sql);
// Цикл для вывода строк


// Retrieve posts from the database
$posts = mysqli_query($con, "SELECT * FROM posts ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1> Чат </h1>

    <form class = "posting" action="add.php" method="post">
        <input class="form-control" type="text" name="list" id ="list" placeholder="Введите текст поста...">
        <button class="btn btn-danger" type="submit" name="send"> Добавить </button>
    </form>
</div>

<!-- display posts gotten from the database  -->
<?php while ($row = mysqli_fetch_array($res_data)) { ?>
<?php echo '<ul>';?>
    <div class="post">
        <?php echo $row['text']; ?>
        <p><?php echo $row['dtime'];?></p>
        <div style="padding: 2px; margin-top: 5px;">
            <?php
            // determine if user has already liked this post
            $results = mysqli_query($con, "SELECT * FROM likes WHERE userid=1 AND postid=".$row['id']."");

            if (mysqli_num_rows($results) == 1 ): ?>
                <!-- user already likes post -->
                <span class="unlike fa fa-thumbs-up" data-id="<?php echo $row['id']; ?>"></span>
                <span class="like hide fa fa-thumbs-o-up" data-id="<?php echo $row['id']; ?>"></span>
            <?php else: ?>
                <!-- user has not yet liked post -->
                <span class="like fa fa-thumbs-o-up" data-id="<?php echo $row['id']; ?>"></span>
                <span class="unlike hide fa fa-thumbs-up" data-id="<?php echo $row['id']; ?>"></span>
            <?php endif ?>

            <span class="likes_count"><?php echo $row['likes']; ?> likes</span>
        </div>
    </div>
    <?php echo '</ul>';?>
<?php } ?>

<ul class="pagination">
    <li><a href="?pageno=1">First</a></li>
    <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
        <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
    </li>
    <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
        <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
    </li>
    <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
</ul>
<!-- Add Jquery to page -->
<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        // when the user clicks on like
        $('.like').on('click', function(){
            var postid = $(this).data('id');
            $post = $(this);

            $.ajax({
                url: 'index.php',
                type: 'post',
                data: {
                    'liked': 1,
                    'postid': postid
                },
                success: function(response){
                    $post.parent().find('span.likes_count').text(response + " likes");
                    $post.addClass('hide');
                    $post.siblings().removeClass('hide');
                }
            });
        });

        // when the user clicks on unlike
        $('.unlike').on('click', function(){
            var postid = $(this).data('id');
            $post = $(this);

            $.ajax({
                url: 'index.php',
                type: 'post',
                data: {
                    'unliked': 1,
                    'postid': postid
                },
                success: function(response){
                    $post.parent().find('span.likes_count').text(response + " likes");
                    $post.addClass('hide');
                    $post.siblings().removeClass('hide');
                }
            });
        });
    });
</script>
</body>
</html>