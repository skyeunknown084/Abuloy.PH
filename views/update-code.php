<?php 
    // require_once './global_call.php';
    // $gcash_public_key = $_ENV['GCASH_PK'];
    $code = $_GET['code'];
?>
<!DOCTYPE html>
<html lang="en">
<?php 
include './global_call.php';
include './config/db_connect.php';
include './head_views.php'; ?>
<!-- <link rel="stylesheet" href="./assets/dist/css/pages/success.css"> -->
</head>
<body>
<div class="py-5">
    <form name="update_code" action="" id="update_code" method="POST">
        <div class="py-5 mt-2 text-center bb-lavander">
            <h4 class="text-lavander">Successful Update of Request Code!</h4>
            <img src="assets/img/check.png" alt="check-freepik" class="my-5" style="height:250px;width:250px">
            <div>request code #:</div>
            <input type="hidden" name="code" value="<?php echo $code;  //Output: url hash ?>">
            <small><b><?php echo $code;  //Output: url code ?></b></small>
            
        </div>
    </form>
    
</div>
<script>
    // Update Database with this unique Hash Code
    $(document).ready(function(){
        $("#update_code").submit();
        // get_web_page($content)             
    })
    $('#update_code').submit(function(e){
        e.preventDefault()
        // start_load()
        $.ajax({
            url:'/ajax?action=update_code',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success:function(data){
                console.log(data);       
            }
        })
          
    });    
</script>

    <!-- Plugins -->
    <?php include_once './plugin_views.php'; ?>
    <!-- Custom Script -->
    <!-- <script src="controllers/update-code.js"></script> -->
</body>
</html>