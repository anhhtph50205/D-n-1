<div class="row">
    <div class="row formtitle">
        <h1>THÊM MỚI HÀNG HÓA</h1>
    </div>

    <div class="row formcontent">
        <form action="index.php?act=adddm" method="post">
            <div class="row mb10">
                <label for="maloai">Mã loại</label> 
                <input type="text" name="maloai" disabled>
            </div>

            <div class="row mb10">
                <label for="tenloai">Tên loại</label>
                <input type="text" name="tenloai" value="<?= isset($tenloai) ? $tenloai : ''; ?>">
                <?php
                    if (isset($error['tenloai'])) {
                        echo "<p style='color: red;'>".$error['tenloai']."</p>";
                    }
                ?>
            </div>

            <div class="row mb10">
                <input type="submit" name="themmoi" value="Thêm mới">
                <input type="reset" value="Nhập lại">
                <a href="index.php?act=listdm"><input type="button" value="Danh sách danh mục"></a>
            </div>

            <?php
                if (isset($thongBao) && ($thongBao != "")) {
                    echo "<p style='color: red;'>".$thongBao."</p>";
                }
            ?>
        </form>
    </div>
</div>
