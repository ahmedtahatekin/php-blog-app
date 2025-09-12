<!DOCTYPE html>
<html lang="tr-TR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Php Blog</title>
</head>
<body style="display: grid;grid-template-columns: 1fr 1fr;margin: 15px 35px;">

    <!--//? add a new blog -->
     <form action="add-blog.php" method="post">
        <header>
            <h2>Blog Ekle</h2>
        </header>
        Başlık: <br><input type="text" name="blog_title" placeholder="Bugün hangi konuda yazacaksın?"><br><br>
        Metin : <br><textarea cols="30" rows="5" name="blog_content" placeholder="Bugün bizimle ne paylaşacaksın?"></textarea>
        <br><br><input type="submit" value="Blog Ekle">
     </form>

     <section>
        <header>
            <h2>Geçmiş Bloglar</h2>
        </header>

        <div>
            <?php
            require_once __DIR__ . "/config/db.php";
            
            $stmt = $conn->prepare("SELECT * FROM blogs ORDER BY id DESC");
            $stmt->execute();

            $blogs_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($blogs_data as $blog) {
                echo $blog['blog_title'] . "<br>";
                echo $blog['blog_content'] . "<br><br><hr>";
            };

            ?>
        </div>
     </section>
</body>
</html>