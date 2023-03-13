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
        if(empty($_POST['prd_name'])) {
            echo "Bạn chưa nhập tên sản phẩm!";
        }else{
            $prd_name = $_POST['prd_name'];
        }
        $prd_details = $_POST['prd_details'];
         
        if(isset($_FILES['prd_image'])) {
            if($_FILES['prd_image']['name']) {
                if($_FILES['prd_image']['error'] > 0) {
                    $prd_image = 'no-img.png';
                }else{
                    //validate đầy đủ (bài làm chỉ minh họa bước upload)
                    $tmp_name = $_FILES['prd_image']['tmp_name'];
                    $target_file = "images/travel/".$_FILES['prd_image']['name'];
                    move_uploaded_file($tmp_name,$target_file);
                    $prd_image = $_FILES['prd_image']['name'];
                }
            }else{
                $prd_image = $prodEdit['prd_image'];
            }
            
        }else{
            $prd_image = $prodEdit['prd_image'];
        }

        $sqlUpdate = "UPDATE product SET
                prd_name = '$prd_name',
                prd_image = '$prd_image',
                prd_details = '$prd_details'
                WHERE prd_id = $prd_id
        ";

        if(mysqli_query($conn, $sqlUpdate)) {
            header("location: index.php?page=product");
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
                                <label>Tên Tour du lịch</label>
                                <input type="text" name="prd_name" required class="form-control" value="<?php echo $prodEdit['prd_name'];  ?>"  placeholder="">
                            </div>                  
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Ảnh Tour du lịch</label>
                                <input type="file"  name="prd_image" onchange="preview();">
                                <br>
                                <div>
                                    <img width="340px" height="200px" id="prd_image" src="images/travel/<?php echo $prodEdit['prd_image'];?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Mô tả Tour du lịch</label>
                                <textarea name="prd_details" required class="form-control" rows="3"><?php echo $prodEdit['prd_details']; ?></textarea>
                            </div>
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