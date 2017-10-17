<html lang="en-US"> <!--<![endif]-->
    <?php
    session_start();
    include_once 'dbConnect.php';
    $uid = $_SESSION['uid'];

    if (isset($_POST['edit'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $date = mysqli_real_escape_string($conn, $_POST['date']);
        $desc = mysqli_real_escape_string($conn, $_POST['desc']);
        $id = mysqli_real_escape_string($conn, $_POST['UploadID']);
        $sql = "UPDATE upload set name='$name', date='$date', description='$desc' where UploadId='$id' ";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo '<script language="javascript">';
            echo 'alert("Updated sucessfully")';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo 'alert("Updation failed. Try again.")';
            echo '</script>';
        }
    }
    if (isset($_POST['delete'])) {
        $id = mysqli_real_escape_string($conn, $_POST['UploadID']);
        $sql = "DELETE from upload where UploadId='$id'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo '<script language="javascript">';
            echo 'alert("Deleted Sucessfully")';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo 'alert("Deletion failed. Try again.")';
            echo '</script>';
        }
    }
    ?>

    <head>

        <!-- Meta Tags -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <title>gallery</title> 


        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
        <script src="js/jquery-1.10.2.js" type="text/javascript"></script>
        <link href="css/galleryupdated.css" rel="stylesheet" type="text/css"/>
        <script src="js/css-pop.js" type="text/javascript"></script>
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
        <link href="css/popup.css" rel="stylesheet" type="text/css"/>
        <script>
            $(window).load(function () {
                $('img.bgfade').hide();
                var dg_H = $(window).height();
                var dg_W = $(window).width();
                $('#wrap').css({'height': dg_H, 'width': dg_W});
                function anim() {
                    $("#wrap img.bgfade").first().appendTo('#wrap').fadeOut(1500);
                    $("#wrap img").first().fadeIn(1500);
                    setTimeout(anim, 6000);
                }
                anim();
            })
            $(window).resize(function () {
                window.location.href = window.location.href
            })
        </script>
    </head>
    <body>
        <nav class="navbar navbar-default" role="navigation">
            <div class="navbar-header">

                <a class="navbar-brand">Photo Library</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="float: right">

                <div class="col-md-9" style="padding-right: 0px">
                    <form class="navbar-form" role="search" >
                        <div class="row">
                            <div class="move">
                                <div class="input-group stylish-input-group">
                                    <input type="text" class="form-control"  placeholder="Search" >
                                    <span class="input-group-addon">
                                        <button type="submit">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </button>  
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" >Menu <b class="caret"></b></a>
                        <ul class="dropdown-menu" >
                            <li ><a href="logout.php">Logout</a></li>
                            <li><a href="index.html">Home</a></li>
                            <li><a href="profile.php">Profile</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
        <div id="wrap">

            <img class="bgfade" src="_include/img/slider-images/image02.jpg" alt=""/>
            <img class="bgfade" src="_include/img/slider-images/image03.jpg" alt=""/>
            <img class="bgfade" src="_include/img/slider-images/image04.jpg" alt=""/>

        </div>
        <div class="nag1">
            <button class="nag2" onclick="window.open('upload.php', '_self');">Upload</button>
        </div>  
        <div class="image">
            <?php
            $result = mysqli_query($conn, "SELECT * FROM upload WHERE UId = '" . $uid . "'");

            while ($row = mysqli_fetch_array($result)) {
                $name = $row['name'];
                $path1 = $row['path1'];
                $date = $row['date'];
                $desc = $row['description'];
                $uploadId = $row['UploadId'];
                ?>

                <a href="#" onclick= "popup('popUpDiv'); javascript:check('<?php echo $name ?>', '<?php echo $date ?>', '<?php echo $desc ?>', '<?php echo $path1 ?>', '<?php echo $uploadId ?>');" >
                    <?php
                    echo '<div class="img">';
                    echo '<img src = "' . $path1 . '" />';
                    echo '<div class = "desc">' . $name . '</div>';
                    echo '</div>';
                    }
                ?>
                    </a>
                
        </div>
        <script type='text/javascript'>

            function check(name, date, desc, path1, id)
            {
                document.getElementById("name").value = name;
                document.getElementById("date").value = date;
                document.getElementById("desc").value = desc;
                document.getElementById("path1").src = path1;
                document.getElementById("id").value = id;
            }

        </script>
        <div id="blanket" style="display:none;"></div>
        <div id="popUpDiv" style="display:none;">
            <a href="#" onclick="popup('popUpDiv')"><img class="close" src="img/close.png" alt=""/></a>
            <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="editdelete">
                <div>

                    <img id="path1" class="upload" src= "" alt=""/>

                    <ul class="submenu">
                        <li>Name <input type="text" id="name" name="name" value="" class="btn-o fa fa-calendar left-none"></li>
                        <li>Date <input type="text" id="date" name="date" value=""  class="btn-o fa fa-calendar left-none"></li>
                        <li>Description <textarea rows="8" cols="22" id="desc" name="desc" style="text-transform: initial"class="btn-o fa fa-calendar left-none"></textarea></li>
                    </ul>
                    <div id="change">
                        <input type="submit" class="b1" name="edit" value="Edit">
                        <input type="submit" class="b1" name="delete" value="Delete">
                        <input type="hidden" id ="id" class="b1" name="UploadID" value="">
                    </div>
                </div>
            </form>

        </div>

    </body>

</html>
