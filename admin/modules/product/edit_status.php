<?php 
 //Lấy các thông tin của sản phẩm cần sửa
 if(isset($_GET['prd_id'])) {
     $prd_id = $_GET['prd_id'];
     $sqlProd = "SELECT * FROM product WHERE prd_id = $prd_id";
     $resultProd = mysqli_query($conn, $sqlProd);
     $prodEdit = mysqli_fetch_assoc($resultProd);
     //Sửa sản phẩm
     //Lấy thông tin mới
    if(isset($_POST['sbm'])) {
        $status = $_POST['status'];
        $sqlUpdate = "UPDATE product SET
                status = '$status'
                WHERE prd_id = $prd_id
        ";

        if(mysqli_query($conn, $sqlUpdate)) {
            header("location: index.php?page=order");
        }else{
            echo "<script>alert('Cập nhật sản phẩm không thành công');</script>";
        }
    }
        //Lưu ý khi người dùng không chọn hình ảnh mới thì lấy tên sản phẩm cũ chèn vào
        // Nếu người dùng có hình ảnh mới thì xử lý bình thường.
     //Viết câu truy vấn cập nhật thông tin sản phẩm
 }else{
     header('location: index.php?page=product');
 }
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li><a href="">Quản lý tin tức du lịch</a></li>
            <li class="active"><?php echo $prodEdit['prd_name'];  ?></li>
        </ol>
    </div><!--/.row-->
    
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Tour du lịch: <?php echo $prodEdit['prd_name'];  ?></h1>
        </div>
    </div><!--/.row-->
    <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-6">
                            <form role="form" method="post" enctype="multipart/form-data"> 
                        <div class="form-group">
                                <label>Trạng thái</label>
                                <!-- <select name="status" required class="form-control">
                                    <option <?php if($prderEdit['status'] == 0) echo 'selected'; ?>>Chưa xử lý</option>
                                    <option <?php if($prderEdit['status'] == 1) echo 'selected'; ?>>Đã xử lý</option>
                                </select> -->
                                <input type="text" name="status" required class="form-control" value="<?php echo $prodEdit['status'];  ?>"  placeholder="">
                            <button type="submit" name="sbm" class="btn btn-primary">Cập nhật</button>
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