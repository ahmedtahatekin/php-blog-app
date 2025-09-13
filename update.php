<!DOCTYPE html>
<html lang="tr-TR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Güncelle</title>
</head>

<body>
    <form action="" method="post">
        <header>
            <h2>Blog Güncelleme</h2>
        </header>

        Yeni Başlık: <input type="text" name="new-blog-title">
        Blog İçeriğini Güncelle: <textarea name="new-blog-content"></textarea>
        <input type="submit" value="Güncelle">
    </form>
    <?php
    require_once __DIR__ . "/config/db.php";

    if (isset($_GET['id']) && isset($_POST['new-blog-title']) && isset($_POST['new-blog-content'])) {
        $id = $_GET['id'];
        $new_blog_title = $_POST['new-blog-title'];
        $new_blog_content = $_POST['new-blog-content'];

        $stmt = $conn->prepare("UPDATE blogs SET blog_title=:new_blog_title, blog_content = :new_blog_content WHERE id = $id");
        $stmt->execute([
            ":new_blog_title" => $new_blog_title,
            ":new_blog_content" => $new_blog_content,
        ]);

        echo "Güncelleme Başarılı " . '<a href="/">Ana Sayfaya Dön</a>';
    }

    ?>
</body>

</html>