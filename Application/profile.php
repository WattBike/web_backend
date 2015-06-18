<?php
    global $base_url;
    define('safeGuard', TRUE);
    define('dbConnected', TRUE);
    define('__ROOT__', dirname(__FILE__));
    require_once(__ROOT__ . '/assets/classes/class.connect.php');
    
	$connection = new Connect;
    if (!isset($_SESSION['mail']) && ($_SESSION['mail'] == "")):
        header('Location: index.php', 401);
    else:
require_once(__ROOT__ . '/assets/include/header.php');
?>

    <div class="col-xs-12 col-md-8 col-md-offset-2">
        <h1 align="center"> Profile </h1>
    </div>
    
    <div class="col-xs-12 col-md-8 col-md-offset-2">
        <img id="profile-img" class="img-circle img-responsive center-block" src="https://randomuser.me/api/portraits/lego/2.jpg" width="120"/>
        <br>
        <div class="col-xs-12 col-md-4 col-md-offset-4">
            <div class="col-xs-6 col-md-5 col-md-offset-1">
                <label>Name:</label>
            </div>
            <div class="col-xs-6 col-md-6">
                <label class="font">Naomi Nazar</label>
            </div>
            <div class="col-xs-6 col-md-5 col-md-offset-1">
                <label>Age:</label>
            </div>
            <div class="col-xs-6 col-md-6">
                <label class="font">20</label>
            </div>
            <div class="col-xs-6 col-md-5 col-md-offset-1">
                <label>Gender:</label>
            </div>
            <div class="col-xs-6 col-md-6">
                <label class="font">Female</label>
            </div>
            <div class="col-xs-6 col-md-5 col-md-offset-1">
                <label>Weight:</label>
            </div>
            <div class="col-xs-6 col-md-6">
                <label class="font">60 kg</label>
            </div>
            <div class="col-xs-6  col-md-5 col-md-offset-1">
                <label>Length:</label>
            </div>
            <div class="col-xs-6 col-md-6">
                <label class="font">164 cm</label>
            </div>
            
        </div>
    </div>


<?php
require_once (__ROOT__ . '/assets/include/header.php');
endif;
?>