<?php

	// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	// Art class
	// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	class Art
	{
		public static function getAllArts() {
            $json = file_get_contents("https://api.artic.edu/api/v1/artworks");
            $response = json_decode($json, TRUE);
			$data = $response["data"]; 
			$allArt = [];
            foreach ($data as $item) {
                array_push($allArt, $item); 
            }
			return $allArt;
		}

		// instance-side method to render a User object to HTML
		public static function toHtml($a) {
			echo "<tr>"
				. "<td>". $a["id"] . "</td>"
				. "<td>". $a["title"] . "</td>"
				. "<td>". $a["artist_display"] . "</td>"
				. "<td><img src=\"https://www.artic.edu/iiif/2/". $a["image_id"] ."/full/843,/0/default.jpg\"img/></td></tr>";
		}

		// class-side method to render an array of users as an HTML table
		public static function showArtsAsTable($arts) {
			echo '<table><thead>
					<tr><th>Id</th><th>Titre</th><th>Artiste</th><th>Tableau</th></tr></thead><tbody>';
			foreach($arts as $a) {
				static::toHtml($a);
			}
			echo '</tbody></table>';
		}

		public static function showAllArtsAsTable() {
			static::showArtsAsTable(static::getAllArts());
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<style>
		table {
			border-top: 1px solid black;
			border-bottom: 1px solid black;
		}

		td {
			text-align: center;
			padding-left: 2em;
			padding-right: 2em;
		}
		</style>
	</head>
	<body>
		<h1>Users</h1>
		<?php
			Art::showAllArtsAsTable();
		?>
	</body>
</html>

