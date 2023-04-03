<?php include 'sidebar.php'; ?>
<?php
if(isset($_GET['repcontactid'])){
    $id=$_GET['repcontactid'];
    $status=$_GET['status'];
    if($status=="0")
    $repcontact=$cont->rep_contact($id);
    
}
?>

    <div class="container">
        <div class="box row">
            <?php 
            // if(isset($delbrand))
            //     echo $delbrand;
            ?>
            <div class="table-responsive">
            <table class="table table-striped">
                    <thead>
                    <tr>
                            <th>Mã</th>
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>Tiêu đề</th>
                            <th>Nội dung</th>
                            <th>Thời gian</th>
                            <th>Chỉnh sửa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $show = $cont->show_contact();
                            if($show){
                                while($result=$show->fetch_assoc()){
                        ?>
                        <tr class="list">
                            <td><?php echo $result['ContactID'];?></td>
                            <td><?php echo $result['FullName']; ?></td>
                            <td><?php echo $result['Email']; ?></td>
                            <td><?php echo $result['Title']; ?></td>
                            <td><?php echo $result['Content']; ?></td>
                            <td><?php echo $result['ContactDate']; ?></td>
                            <td style="width:50px">
                            
                            <?php if($result['Status']=="0"){ ?>
                                <button type="button" class="btn btn-primary order-status order-ready" onclick="window.location.href='?act_admin=replycontact&contID=<?php echo $result['ContactID'] ?>'">
                                Phản hồi</button>
                            <?php }else{?>
                                <span class="order-status order-shipped">Đã phản hồi </span>
                            <?php }
                            ?>
                            </td>
                        </tr>
                        <?php 
                        }}
                        ?>
                    </tbody>
            </table>
                <?php 
                $show_all=$cont->show_all_contact();
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
                    <a href="?act_admin=contactlist&trang=<?php echo $i ?>" class="<?php 
                    if(!isset($_GET['trang'])){
                        echo (isset($_GET['contactlist']))?"active":"";                    }else{
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
