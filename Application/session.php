<?php
    global $base_url;
	define('safeGuard', TRUE);
	define('dbConnected', TRUE);
	define('__ROOT__', dirname(__FILE__));
	require_once(__ROOT__ . '/assets/include/connect.php');
	require_once(__ROOT__ . '/assets/include/header.php');
	require_once(__ROOT__ . '/assets/include/config.php');
	if (!isset($_SESSION['mail']) && ($_SESSION['mail'] == "")):
	    header('Location: $base_url/index.php', 401);
	else:
?>
<div class="container">
    <h1>Welcome to wattbike <small><?php echo $_SESSION['first_name']; ?></small></h1>
    <h2>A new session is started</h2>
    <a class="btn btn-primary" href="display.php">Back</a>
    <a class="btn btn-warning" href="index.php">Logout</a>
    <form method="post" id="session">
        <select name="session">
            <option value="0">Choose a session</option>
            <?php $rows = get_total_session();
                $session_nr=0;
                for($i = 0; $i < count($rows); ++$i):
                    $row = $rows[$i]; 
                    $session_nr++; ?>
                    <option value="<?php echo $row['session_nr']; ?>"><?php echo $session_nr ?></option>
            <?php endfor; ?>
        </select>
        <input class="btn btn-primary" type="submit" name="submit">
    </form>
    
    <?php 
        if(isset($_POST['submit'])){
            $session=$_POST['session'];
            echo "You have selected :" .$session; // Displaying Selected Value
        }
    ?>
	<table class="table">
		<thead>
		    <tr>
		    	<th>#</th>
                <th>bpm</th>
		      	<th>time</th>
	    	</tr>
	  	</thead>
	  	<tbody>
            <?php $rows = get_user_session();
            
                for($i = 0; $i < count($rows); ++$i):
                    $row = $rows[$i];
                    if($session>0){}
            ?>
                <tr>
                    <td><?php echo $row['new_session_nr']; ?></td>
                    <td><?php echo $row['bpm']; ?></td>
                    <td><?php echo $row['time']; ?></td>
                </tr>
            <?php endfor; ?>
	    </tbody>
	</table>
</div><!-- /card-container -->
<?php
	require_once "assets/include/footer-tags.php";
?>
<script type="text/javascript">
	jQuery(document).ready(function () {
//		refresh();
		function refresh(){
			jQuery.ajax({
				url: "<?php echo $base_url; ?>/rest.php",
				context: document.body,
				dataType: "json"
			}).done(function (data) {
				jQuery('tbody').html('');
				for (var i = 0; i < data.length; i++) {
					var oldData = jQuery('tbody').html();
					jQuery('tbody').html(
						oldData
						+ "<tr>"
						+ "		<td>" + data[i].newName + "</td>"
						+ "		<td>" + data[i].bpm + "</td>"
						+ "		<td>" + data[i].time + "</td>"
						+ "</tr>"
					);
				}
			});
			setTimeout(refresh, 15000);
		}
	});
</script>
<?php
	require_once "assets/include/end-tags.php";
?>
<?php endif; ?>
