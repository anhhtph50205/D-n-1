<div class="row">
    <div class="row formtitle mb">
        <h1>DANH SÁCH SẢN PHẨM</h1>
    </div>

    <form action="index.php?act=listsp" method="post">
        <input type="text" name="kyw">
        <select name="iddm" id="">
            <option value="0" selected>Tất cả</option>
            <?php
            foreach ($listdanhmuc as $danhmuc) {
                extract($danhmuc);
                echo '<option value=' . $id . '>' . $name . '</option>';
            }
            ?>
        </select>
        <input type="submit" name="listok" value="Tìm Kiếm">
    </form>
    
    <div class="row formcontent">
        <div class="row mb10 formdsloai">
            <table>
                <tr>
                    <th>Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Hình</th>
                    <th>Giá</th>
                    <th>Mô Tả</th>
                    <th>Thao Tác</th>
                </tr>
                <?php
                foreach ($listsanpham as $sanpham) {
                    extract($sanpham);
                    $suasp = "index.php?act=suasp&id=" . $id;
                    $xoasp = "index.php?act=xoasp&id=" . $id;
                    $hinhpath = '../uploads/' . $img;
                    if (is_file($hinhpath)) {
                        $hinh = "<img src='" . $hinhpath . "' height='90' >";
                    } else {
                        $hinh = 'no photo';
                    }
                    echo '<tr>
                            <td>' . $id . '</td>
                            <td>' . $name . '</td>
                            <td>' . $hinh . '</td>
                            <td>' . $price . '</td>  
                            <td>' . $mota . '</td>                        
                            <td>
                                <a href="' . $suasp . '"><input type="button" value="sửa"></a>
                                <a href="' . $xoasp . '" onclick="return confirm(\'Bạn có chắc chắn muốn xóa?\');"><input type="button" value="xóa"></a>    
                            </td>
                        </tr>';
                }
                ?>
            </table>
        </div>
        
        <div class="row mb10">
            <a href="index.php?act=addsp "><input type="button" value="Nhập thêm"></a>
        </div>
    </div>
</div>