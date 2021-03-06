<?php
	define('safeGuard', TRUE);
	define('__ROOT__', dirname(__FILE__));
	require_once(__ROOT__ . '/assets/classes/class.connect.php');
	require_once(__ROOT__ . '/assets/include/header.php');
	$connection = new Connect;
	if (!key_exists("mail", $_SESSION) || $_SESSION['mail']==""):
	 	$connection->redirect("index.php", 401);
  	else:
?>
<div class="container">
	<a class="btn btn-default" href="index.php">&larr; Back</a>
    <h1>Welcome to wattbike <small><?php echo $_SESSION['first_name']; ?></small></h1>
    <form method="post" id="session" class="form-inline">
      <b>Viewing session:</b>
			<select name="session_select" class="form-control" id="sessionSelector">
            <option value="-1|-1">Choose a session</option>
            <?php $rows = $connection->get_total_session();
                $session_nr=0;
                for($i = 0; $i < count($rows); ++$i):
                    $row = $rows[$i]; 
                    $session_nr++; ?>
                    <option value="<?php echo $row['session_nr']; ?>|<?php echo $session_nr ?>"><?php echo $session_nr ?></option>
            <?php endfor; 
            
            ?>
        </select>    
    </form>
    <?php
    	// $session_result = $_POST['session_select'];
    	// echo $session_result;
        // $result_explode = explode('|', $session_result);
        // echo "DBsession: ". $result_explode[0]."<br />";
        // echo "newSession: ". $result_explode[1]."<br />";
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
           <?php $rows = $connection->get_user_session(0);            
                for($i = 0; $i < count($rows); ++$i):
                    $row = $rows[$i];
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
		refresh();

		$("#sessionSelector").change(function () {
			refresh();
		});

		function refresh(){
			var newsession = $("#sessionSelector option:selected").val();
			jQuery.ajax({
				url: "<?php echo $connection->getUrl(); ?>/rest.php?session=" +newsession+ "",
				context: document.body,
				dataType: "json"
			}).done(function (data) {
				jQuery('tbody').html('');
				for (var i = 0; i < data.length; i++) {
					var oldData = jQuery('tbody').html();
					jQuery('tbody').html(
						oldData
						+ "<tr>"
						+ "		<td>" + data[i].new_session_nr + "</td>"
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
