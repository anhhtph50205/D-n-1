<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DỰ ÁN MẪU</title>
    <link rel="stylesheet" href="view/css/style.css">
</head>
<body>
    <div class="boxcenter">
        <div class="row mb header">
            <h1>GARA Ô TÔ</h1>
        </div>
        
        <div class="row mb menu">
            <ul>
                <li><a href="index.php"> Trang Chủ </a></li>
                <li><a href="index.php?act=gioithieu"> Giới Thiệu </a></li>
                <li><a href="index.php?act=lienhe"> Liên Hệ </a></li>
                <li><a href="index.php?act=gopy"> Góp Ý </a></li>
                <li><a href="index.php?act=hoidap"> Hỏi Đáp </a></li>
            </ul>

            <div class="">
        <form action="index.php?act=sanpham" method="post">
            <input type="text" name="kyw" placeholder="Từ khóa tìm kiếm">
            <input type="submit" name="timkiem" value="Tìm kiếm">
        </form>
    </div>
        </div>