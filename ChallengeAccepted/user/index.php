<?php

	require '../includes/connection.php';
	require '../includes/header.php';
	require '../includes/menu_user.php';
	require '../includes/session.php';
	confirm_logged_in();

	$per_page = 10;

	$page_query = mysql_query("SELECT COUNT('feed_id') FROM feed");
	$pages = ceil(mysql_result($page_query, 0) / $per_page);

	$page = (isset($_GET['page'])) ? (int)$_GET['page']: 1; #genius shit i dont cekn understand
	$start = ($page - 1) * $per_page;

	$query = mysql_query("SELECT * FROM feed ORDER BY feed_id DESC LIMIT $start, $per_page");

	$count = 0;

	echo "<table class='main_table'>";
		while($row = mysql_fetch_assoc($query)){
			$count+= 1;
				echo "<tr>";
					echo "<td id='feed_number'>";
						echo "<table>";
							echo "<tr>";
								echo "<td>";
									echo  $count.".";
								echo "</td>"; 
							echo "</tr>";
							echo "<tr>";
								echo "<td>";
									echo '&nbsp;';
								echo "</td>"; 
							echo "</tr>";
						echo "</table>";
					echo "</td>";
					echo "<td id='feed_content'>";
						echo "<table>";
							echo "<tr>";
								echo "<td>";
									//echo  "<b>" . $row['feed_title'] .  "</b>";
									echo "<b><a id='feed_title' href='view.php?id=" . $row['feed_id'] . "'> " . $row['feed_title'] . " </a></b>";
								echo "</td>"; 
							echo "</tr>";

							echo "<tr>";
								echo "<td id='bottom_feed'>";
									echo "<b><a id='arrow' href='add_point.php?id=" . $row['feed_id'] . "'> " . "&uarr;" . " </a></b>";
									echo " " . $row['feed_point'] . " points by " . $row['feed_user'] . " " ." | ". $row['feed_time'];
								echo "</td>";
							echo "</tr>"; 

						echo "</tr>"; 

						echo "</table>";
					echo "<td>";
				echo "</tr>";

		}
	echo "</table>";

	echo "<hr>";

	if ($pages >= 1) {
		echo "page: ";
		for ($i = 1; $i <= $pages; $i++) { 
			echo '<a href="?page=' . $i . '">'. $i . '</a>';
			echo " ";		
		}
	}

?>

<?php
	require '../includes/footer.php';
?>
