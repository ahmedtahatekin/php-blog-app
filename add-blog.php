<?php
require_once "config/db.php";

$blog_title = $_POST['blog_title'];
$blog_content = $_POST['blog_content'];

$msg = "Blog Başarıyla Eklendi.";

function setInput(string $input): string {
    $input = htmlspecialchars($input);
    $input = stripslashes($input);
    $input = trim($input);

    return $input;
}

$stmt = $conn->prepare(
    "INSERT INTO blogs(blog_title, blog_content) VALUES (:blog_title, :blog_content)"
);

if (($blog_title === null || $blog_title === "") && !($blog_content === null || $blog_content === "")) {
    $blog_title = "Başlıksız";

    $stmt->execute([
        ":blog_title" => setInput($blog_title),
        ":blog_content" => setInput($blog_content),
    ]);
} elseif ($blog_content === null || $blog_content === "") {
    $msg = "Ekleme Başarısız: içerik boş olamaz!";
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ekleme Başarılı</title>
</head>

<body>
    <?php echo $msg ?> <a href="/">Ana Sayfaya Dön</a>
</body>

</html>