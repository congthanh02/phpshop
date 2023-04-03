<?php include 'sidebar.php'; ?>
<?php
if(isset($_GET['confirmid'])){
    $id=$_GET['confirmid'];
    $status=$_GET['status'];
    if($status=="0")
    $confirmorder=$order->confirm_order($id);
    else{
    $confirmorder=$order->confirm2_order($id);
    }
    
}
?>
    <div class="container">
        <div class="box row">
            <h4 class="header_h4">Danh sách đơn hàng</h4>
            <?php 
            // if(isset($delbrand))
            //     echo $delbrand;
            ?>
            <div class="table-responsive">
            <table class="table table-striped">
                    <thead>
                    <tr>
                            <th>Mã Đơn hàng</th>
                            <th>Họ tên</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Hình thức TT</th>
                            <th>Thời gian đặt hàng</th>
                            <th>Tổng tiền</th>
                            <th>Mã KH</th>
                            <th colspan="2">Chỉnh sửa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $show = $order->show_order();
                            if($show){
                                while($result=$show->fetch_assoc()){
                        ?>
                        <tr class="list">
                            <td><?php echo $result['OrderID'];?></td>
                            <td><?php echo $result['Fulname']; ?></td>
                            <td><?php echo $result['Phonenumber']; ?></td>
                            <td><?php echo $result['Address']; ?></td>
                            <td><?php echo $result['Shippingtype']; ?></td>
                            <td><?php echo $result['OrderDate']; ?></td>
                            <td><?php echo $result['Totalprice']; ?></td>
                            <td><?php echo $result['CustomerID']; ?></td>
                            <td style="width:50px">                                
                                <?php
                                if($result['Status']=="0"){?>
                                    <button type="button" class="btn btn-primary order-status order-confirm" onclick="window.location.href='?act_admin=orderlist&confirmid=<?php echo $result['OrderID'];?>&status=<?php echo $result['Status']; ?>'">Xác nhận</button>
                                <?php }elseif($result['Status']=="1"){?>
                                    <button type="button" class="btn btn-primary order-status order-ready" onclick="window.location.href='?act_admin=orderlist&confirmid=<?php echo $result['OrderID'];?>&status=<?php echo $result['Status']; ?>'">Gửi hàng</button>
                                <?php }else{ ?>
                                    <span class="order-status order-shipped">Đang giao </span>
                                <?php }?>
                                
                            </td>
                            <td style="width: 50px;"> <button type="button" onclick="window.location.href='?act_admin=orderdetails&orderID=<?php echo $result['OrderID'];?>'" class="btn btn-primary order-status order-ready">Chi tiết</button></td>
                        </tr>
                        <?php 
                        }}
                        ?>
                    </tbody>
            </table>
                <?php 
                $show_all=$order->show_all_order();
                $count= mysqli_num_rows($show_all);
                $page_button=ceil($count/10);
                ?>
            <ul class="pagination modal-1">
                <li><a href="#" class="prev">&laquo</a></li>
                <li>
                    <?php
                    $i=1;
                    for($i=1;$i<=$page_button;$i++){
                    ?>
                    <a href="?act_admin=orderlist&trang=<?php echo $i ?>" class="<?php 
                    if(!isset($_GET['trang'])){
                        echo (isset($_GET['orderlist']))?"active":"";                    }else{
                    echo (basename($_GET['trang'])=="$i")?"active":""; }  ?>">
                    <?php echo $i ?>
                    </a>
                    <?php }?>
                </li>
                <li><a href="#" class="next">&raquo;</a></li>
            </ul>
            </div>
        </div>
    </div>
    </div>

    <!-- END MAIN CONTENT -->
<?php include 'footer.php'; ?>
