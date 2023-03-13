<?php
    //Thêm sản phẩm
    if(isset($_POST['sbm'])) {
        if(empty($_POST['prd_name'])) {
            echo "Bạn chưa nhập tên Tour du lịch!";
        }else{
            $prd_name = $_POST['prd_name'];
        }
        $user_full = $_POST['user_full'];
        $created = date('Y-m-d H:i:s');//datetime
        $status = 0;
        $prd_details = $_POST['prd_details'];
         
        if(isset($_FILES['prd_image'])) {
            if($_FILES['prd_image']['error'] > 0) {
                $prd_image = 'no-img.png';
            }else{
                //validate đầy đủ (bài làm chỉ minh họa bước upload)
                $tmp_name = $_FILES['prd_image']['tmp_name'];
                $target_file = "images/travel/".$_FILES['prd_image']['name'];
                move_uploaded_file($tmp_name,$target_file);
                $prd_image = $_FILES['prd_image']['name'];
            }
        }
        $sqlInsert = "INSERT INTO product(prd_name, user_full, prd_image, created, status, prd_details) VALUES 
        ('$prd_name', '$user_full', '$prd_image', '$created', '$status', '$prd_details')";

        if(mysqli_query($conn, $sqlInsert)) {
            header("location: index.php?page=product");
        }else{
            echo "<script>alert('Thêm Tour du lịch không thành công');</script>";
        }
}   
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li><a href="">Quản lý Tour du lịch</a></li>
            <li class="active">Thêm Tour du lịch</li>
        </ol>
    </div><!--/.row-->
    
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm tin tức du lịch</h1>
        </div>
    </div><!--/.row-->
    <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-6">
                        <form role="form" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Tên Tour du lịch</label>
                                <input required name="prd_name" class="form-control" placeholder="">
                            </div> 
                            <div class="form-group">
                                <label>Tên tác giả</label>
                                <input required name="user_full" class="form-control" placeholder="">
                            </div>                                                          
                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Ảnh Tour du lịch</label>
                                <input required name="prd_image" type="file" onchange="preview();">
                                <br>
                                <div>
                                    <img id="prd_image" width="340px" height="200px" src="img/no-img.png">
                                </div>
                            </div>                           
                            <div class="form-group">
                                    <label>Mô tả Tour du lịch</label>
                                    <textarea required name="prd_details" class="form-control" rows="3"></textarea>
                                </div>
                            <button name="sbm" type="submit" class="btn btn-success">Thêm mới</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div><!-- /.col-->
        </div><!-- /.row -->
    
</div>	<!--/.main-->	
<script>
    function preview() {
        prd_image.src=URL.createObjectURL(event.target.files[0]);
    }
</script>