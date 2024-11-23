<?php
    function viewcart($del) {
        global $img_path;
        $tong = 0;
        $i = 0;
            if ($del==1) {
                $xoasp_th = '<th>THAO TÁC</th>';
                $xoasp_td2 = '<td></td>';
            } else {
                $xoasp_th = "";
                $xoasp_td2 = "";
            }

            echo '<tr>
                        <th>HÌNH</th>
                        <th>SẢN PHẨM</th>
                        <th>ĐƠN GIÁ</th>
                        <th>SỐ LƯỢNG</th>
                        <th>THÀNH TIỀN</th>
                        '.$xoasp_th.'
                        </tr>';

            foreach ($_SESSION['mycart'] as $cart) {
                $hinh = $img_path . $cart[2];
                $ttien = $cart[3] * $cart[4];
                $tong += $ttien;
                if ($del==1) {
                    $xoasp_td = '<td><a href="index.php?act=delcart&idcart=' . $i . '"><input type="button" value="Xóa"></a></td>';
                } else {
                    $xoasp_td = "";
                }
                echo '
                    <tr>
                    <td><img src="' . $hinh . '" alt="" height="80px"></td>
                    <td>' . $cart[1] . '</td>
                    <td>' . $cart[3] . '</td>
                    <td>' . $cart[4] . '</td>
                    <td>' . $ttien . '</td>
                    ' . $xoasp_td . '
                    </tr>';
                    $i += 1;
                    }
                echo '<tr>
                        <td colspan="4">Tổng đơn hàng</td>
                        <td>' . $tong . '$</td>
                        '.$xoasp_td2.'
                    </tr>';
    }

    function bill_chi_tiet($listbill) {
        global $img_path;
        $tong = 0;
        $i = 0;           
            echo '<tr>
                    <th>HÌNH</th>
                    <th>SẢN PHẨM</th>
                    <th>ĐƠN GIÁ</th>
                    <th>SỐ LƯỢNG</th>
                    <th>THÀNH TIỀN</th>
                 </tr>';

            foreach ($listbill as $cart) {
                $hinh = $img_path . $cart['img'];
                $tong += $cart['thanhtien'];               
                echo '
                    <tr>
                    <td><img src="' . $hinh . '" alt="" height="80px"></td>
                    <td>' . $cart['name'] . '</td>
                    <td>' . $cart['price'] . '</td>
                    <td>' . $cart['soluong'] . '</td>
                    <td>' . $cart['thanhtien'] . '</td>
                    </tr>';
                    $i += 1;
                    }
                echo '<tr>
                        <td colspan="4">Tổng đơn hàng</td>
                        <td>' . $tong . '$</td>
                    </tr>';
    }

    function tongdonhang() {
        $tong = 0;

            foreach ($_SESSION['mycart'] as $cart) {
                $ttien = $cart[3] * $cart[4];
                $tong += $ttien;
                
            }   
            return $tong;
    }

    function insert_bill($iduser, $name, $email, $address, $tel, $pttt, $ngaydathang, $tongdonhang, $status = 0) {
        $sql = "INSERT INTO bill(iduser, bill_name, bill_email, bill_address, bill_tel, bill_pttt, ngaydathang, total, bill_status)  VALUES('$iduser', '$name', '$email', '$address', '$tel', '$pttt', '$ngaydathang', '$tongdonhang', '$status')";
        return pdo_execute_return_lastInsertId($sql);
    }
    
    function update_bill_status($bill_id, $new_status) {
        $sql = "UPDATE bill SET bill_status = '$new_status' WHERE id = '$bill_id'";
        pdo_execute($sql);
    }
    
    function insert_cart($iduser, $idpro, $img, $name, $price, $soluong, $thanhtien, $ibbill) {
        $sql = "INSERT INTO cart(iduser, idpro, img, name, price, soluong, thanhtien, ibbill) VALUES('$iduser', '$idpro', '$img', '$name', '$price', '$soluong', '$thanhtien', '$ibbill')";
        return pdo_execute($sql);
    }

    function loadone_bill($id) {
        $sql = "SELECT * FROM bill WHERE id=".$id;
        $bill = pdo_query_one($sql);
        return $bill;
    }

    function loadall_cart($idbill) {
        $sql = "SELECT * FROM cart WHERE ibbill=".$idbill;
        $bill = pdo_query($sql);
        return $bill;
    }

    function loadall_bill($kyw="" ,$iduser=0) {
        $sql ="SELECT * FROM bill WHERE 1";
        if ($iduser>0) $sql.=" AND iduser=".$iduser;
        if ($kyw!="") $sql.=" AND id like '%".$kyw."%' ";
        $sql.=" ORDER BY id DESC";
        $listbill = pdo_query($sql);
        return $listbill;
    }

    function get_ttdh($n) {
        switch ($n) {
            case '0':
                return "Đang xử lý";  // Ví dụ thay đổi trạng thái tùy theo phương thức
            case '1':
                return "Chờ xác nhận";
            case '2':
                return "Đang giao";
            case '3':
                return "Đã giao";
            default:
                return "Trạng thái không xác định";
        }
    }
    

    function loadall_cart_count($idbill) {
        $sql = "SELECT * FROM cart WHERE ibbill=".$idbill;
        $bill = pdo_query($sql);
        return sizeof($bill);
    }

    function loadall_thongke() {
        $sql ="SELECT danhmuc.id as madm, danhmuc.name as tendm, COUNT(sanpham.id) as countsp, MIN(sanpham.price) as minprice, MAX(sanpham.price) as maxprice, AVG(sanpham.price) as avgprice";
        $sql.=" FROM sanpham left join danhmuc on danhmuc.id=sanpham.iddm";
        $sql.=" GROUP BY danhmuc.id ORDER BY danhmuc.id DESC";
        $listtk = pdo_query($sql);
        return $listtk;
    }

    function get_payment_method($payment_code) {
        switch ($payment_code) {
            case 0:
                return "Thanh toán trực tiếp";
            case 1:
                return "Chuyển khoản";
            case 2:
                return "Thanh toán online";
            case 3:
                return "Ví điện tử";
            default:
                return "Chưa xác định"; 
        }
    }
    
?>