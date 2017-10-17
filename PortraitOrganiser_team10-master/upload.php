<html>
    <?php
    session_start();
    ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href = "css/menu.css" rel = "stylesheet" type = "text/css"/>
    <link href="css/upload.css" rel="stylesheet" type="text/css"/>
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src = "js/jquery.min.js" type = "text/javascript"></script>
    <script src="js/jquery.form.js" type="text/javascript"></script>
    <script src="js/supersized.3.2.7.min.js"></script>
    <script src="js/supersized-init.js"></script>
    <link rel="stylesheet" href="css/supersized.css">
    <script>
        $(document).on('change', '#image_upload_file', function () {
            var progressBar = $('.progressBar'), bar = $('.progressBar .bar'), percent = $('.progressBar .percent');

            $('#image_upload_form').ajaxForm({
                beforeSend: function () {
                    progressBar.fadeIn();
                    var percentVal = '0%';
                    bar.width(percentVal)
                    percent.html(percentVal);
                },
                uploadProgress: function (event, position, total, percentComplete) {
                    var percentVal = percentComplete + '%';
                    bar.width(percentVal)
                    percent.html(percentVal);
                },
                success: function (html, statusText, xhr, $form) {
                    obj = $.parseJSON(html);
                    if (obj.status) {
                        var percentVal = '100%';
                        bar.width(percentVal)
                        percent.html(percentVal);
                        $("#imgArea>img").prop('src', obj.image_medium);
                    } else {
                        alert(obj.error);
                    }
                },
                complete: function (xhr) {
                    progressBar.fadeOut();
                }
            }).submit();

        });
    </script>

    <h1> Upload Photo</h1>

    <div class="row">
        <div class="search">
            <ul class="nav1">

                <li id="options">
                    <a href="#" >Menu</a>
                    <ul class="subnav">
                        <li><a href="logout.php">Log out</a></li>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="gallery.php">Photo Library</a></li>
                        <li><a href="profile.php">Profile</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Contenedor -->
        <ul id="accordion" class="accordion">
            <form enctype="multipart/form-data" action="upload_image.php" method="post" name="image_upload_form" id="image_upload_form">
                <li>

                    <div id="imgContainer" class="iamgurdeep-pic">

                        <div id="imgArea" ><img src="img/photo_upload.png" alt="Image Unavailable"/>

                            <div class="progressBar">
                                <div class="bar"></div>
                                <div class="percent">0%</div>
                            </div>
                        </div>
                        <div id="imgChange"><span>Upload</span>
                            <input type="file" accept="image/*" name="image_upload_file" id="image_upload_file" >
                        </div>
                    </div>

                </li>
                <li>
                    <div class="link"><i class="fa fa-globe"></i>Photo Information</div>
                    <ul class="submenu">
                        <li>Name: <input type="text" id="name" name="name" value=" " class="btn-o fa fa-calendar left-none "></li>
                        <li>Date: <input type="text" id="date" name="date" value=" " class="btn-o fa fa-calendar left-none "></li>
                        <li style=" text-align: center; display: block; margin-left: auto; margin-right: auto;" >Description: <textarea rows="10" cols="30" id="desc" name="desc"></textarea></li>
                        <div style="text-align:center;">
                            <li><input type="submit" id="save" name="save" value="SAVE"  onclick="alertBox();" class="btn-o fa fa-calendar left-none">
                        </div>
                    </ul>
                </li>
            </form>

        </ul>
    </div>
    <script>
        function alertBox() {
            alert("Updated Successfully");
            location.reload();
        }
    </script>
</html>