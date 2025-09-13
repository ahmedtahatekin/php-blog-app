<!DOCTYPE html>
<html lang="tr-TR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Php Blog</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="grid grid-cols-2 gap-10 my-4 mx-8 bg-cyan-600">

    <!--//? add a new blog -->
    <form class="bg-sky-500 p-3 rounded-3xl" action="add-blog.php" method="post">
        <header>
            <h2>Blog Ekle</h2>
        </header>
        Başlık: <br><input class="bg-blue-100/40 p-1 w-78 " type="text" name="blog_title" placeholder="Bugün hangi konuda yazacaksın?"><br><br>
        Metin : <br><textarea class="bg-blue-100/40 p-1" cols="40" rows="5" name="blog_content" placeholder="Bugün bizimle ne paylaşacaksın?"></textarea>
        <br><br><input class="bg-blue-100/40 border-1 border-black-500 p-1 hover:bg-sky-100/60" type="submit" value="Blog Ekle">
    </form>

    <?php
    require_once __DIR__ . "/config/db.php";

    $stmt = $conn->prepare("SELECT * FROM blogs ORDER BY id DESC");
    $stmt->execute();

    $blogs_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <!--//? show the last blogs -->
    <section class="bg-sky-500 p-3 rounded-3xl">
        <header>
            <h2>Geçmiş Bloglar</h2>
        </header>

        <div>
            <ul class="list-none">
                <?php
                foreach ($blogs_data as $blog) {
                    $id = $blog['id'];
                    echo "<li data-id='$id'>" .
                        "<div class='bg-sky-100/50 mb-1'>" .
                        "<h3>" . $blog['blog_title'] . "</h3><br>" .
                        "<p class='text-justify'>" . $blog['blog_content'] . "</p><br>" .

                        "<form action='update.php' method='get'>" .
                        "<input type=hidden name='id' value='$id'>" .
                        "<button class='w-45 bg-blue-100/40 border-t-1 border-l-1 border-r-1 border-fuchsia-400 rounded-t-lg p-1 mt-1 hover:bg-sky-100/60' data-id='$id' type='submit'>Güncelle</button>" .
                        "</form>" .

                        "<form method='post' action='delete.php'>" .
                        "<input type='hidden' name='delete-id' value='$id'>" .
                        "<button class='w-45 text-center bg-blue-100/40 border-b-1 border-l-1 border-r-1 border-fuchsia-400 rounded-b-lg p-1 mb-1 hover:bg-sky-100/60' data-id='$id' name='delete'>Sil</button>" .
                        "</form>" .
                        "</div>" .
                        "</li>";
                };

                ?>
            </ul>
        </div>
    </section>
</body>

</html>