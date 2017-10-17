<html>

    <?php
    session_start();
    include_once 'dbConnect.php';
    $uid = $_SESSION['uid'];
    $dob = "";
    $address = "";
    $phone = "";
    $nickname = "";
    $desc = "";
    if (isset($_POST['save'])) {
        $dob = mysqli_real_escape_string($conn, $_POST['date']);
        $address = mysqli_real_escape_string($conn, $_POST['add']);
        $phone = mysqli_real_escape_string($conn, $_POST['ph']);
        $nickname = mysqli_real_escape_string($conn, $_POST['nname']);
        $desc = mysqli_real_escape_string($conn, $_POST['desc']);

        $sql = "INSERT INTO profiledetails (dob,address,phone,nickname,description,UId) 
            VALUES ('" . $dob . "', '" . $address . "', '" . $phone . "', '" . $nickname . "', '" . $desc . "', '" . $uid . "')
            ON DUPLICATE KEY UPDATE
            dob='$dob', address='$address', phone='$phone', nickname='$nickname', description='$desc'";
        if (mysqli_query($conn, $sql)) {
            echo '<script language="javascript">';
            echo 'alert("Updated sucessfully")';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo 'alert("Updation failed. Try again.")';
            echo '</script>';
        }
    }
    $result = mysqli_query($conn, "SELECT * FROM profiledetails WHERE UId = '" . $uid . "'");

    if ($row = mysqli_fetch_array($result)) {
        $dob = $row['dob'];
        $address = $row['address'];
        $phone = $row['phone'];
        $nickname = $row['nickname'];
        $desc = $row['description'];
    }
    ?>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel = "stylesheet" href = "css/profile.css">
    <link href = "css/menu.css" rel = "stylesheet" type = "text/css"/>
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
        $(document).ready(function () {

            $("form input[type=text]").prop("readonly", true);
            $('form input[type=text],textarea').prop('readonly', 'readonly');

            $("input[name=edit]").on("click", function () {

                $("input[type=text]").removeAttr("readonly");
                $("input[type=text],textarea").removeAttr("readonly");
            })

            $("input[name=save]").on("click", function () {

                $("input[type=text]").prop("readonly", true);
            })


        })
    </script>



    <h1> User Profile</h1>

    <div class="row">
        <div class="search">
            <ul class="nav1">

                <li id="options">
                    <a href="#" >Menu</a>
                    <ul class="subnav">
                        <li><a href="logout.php">Log out</a></li>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="gallery.php">Photo Library</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Contenedor -->
        <ul id="accordion" class="accordion">
            <?php
            $path = "";
            $res = mysqli_query($conn, "select path from profiledetails where UId = '$uid'");
            if ($row = mysqli_fetch_array($res)) {
                $path = $row['path'];
            } else
                $path = 'img/default.jpg';
            ?>

            <li>
                <div id="imgContainer" class="iamgurdeep-pic">
                    <form enctype="multipart/form-data" action="image_upload_demo_submit.php" method="post" name="image_upload_form" id="image_upload_form">
                        <div id="imgArea" ><img src="<?php echo $path; ?>" alt="img/default.jpg"/>

                            <div class="progressBar">
                                <div class="bar"></div>
                                <div class="percent">0%</div>
                            </div>
                        </div>
                        <div id="imgChange"><span>Upload</span>
                            <input type="file" accept="image/*" name="image_upload_file" id="image_upload_file" >
                        </div>
                    </form>
                </div>
            </li>
            <li>

                <div class="link"><i class="fa fa-globe"></i>About</div>
                <ul class="submenu">
                    <li style="text-transform: uppercase;"><h2><?php echo $_SESSION['fname']; ?></h2></li>
                    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="profileinfo">
                        <li>Date of Birth: <input type="text" id="date" name="date" value="<?php echo $dob; ?>" class="btn-o fa fa-calendar left-none "></li>
                        <li>Address: <input type="text" id="add" name="add" value="<?php echo $address; ?>" class="btn-o fa fa-calendar left-none "></li>
                        <li>Phone: <input type="text" id="ph" name="ph" value="<?php echo $phone; ?>" class="btn-o fa fa-calendar left-none "></li>
                        <li>Nickname: <input type="text" id="nname" name="nname" value="<?php echo $nickname; ?>" class="btn-o fa fa-calendar left-none "></li>
                        <li style=" text-align: center; display: block; margin-left: auto; margin-right: auto;">Description about me: <textarea rows="5" cols="25" id="desc" name="desc" class="btn-o fa fa-calendar left-none"><?php echo $desc; ?></textarea></li>
                        <div style="text-align:center;">
                            <li><input type="submit" id="save" name="save" value="SAVE"  class="btn-o fa fa-calendar left-none">
                                <input type="button" id="edit" name="edit" value="EDIT"  class="btn-o fa fa-calendar left-none"></li>
                        </div>
                    </form>
                </ul>
            </li>

        </ul>
    </div>
</html>