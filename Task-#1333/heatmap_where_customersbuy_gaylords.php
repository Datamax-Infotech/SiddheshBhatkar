<?php
	require("../mainfunctions/database.php");
	require("../mainfunctions/general-functions.php");
?>

<!DOCTYPE html">
<html>
	<head>

		<meta charset="utf-8">

		<title>Heat Map: Gaylord Customers</title>

		<link rel='stylesheet' type='text/css' href='css/ucb_common_style.css'>

		<link rel='stylesheet' type='text/css' href='one_style.css'>

		<link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">

		<style>
			body,
			html {
				margin: 0;
				padding: 0;
				height: 100%;
			}

			h1 {
				position: absolute;
				background: white;
				padding: 10px;
			}

			#map {
				height: 100%;
			}

			.leaflet-container {

				background: rgba(0, 0, 0, .8) !important;

			}

			h1 {
				position: absolute;
				background: black;
				color: white;
				padding: 10px;
				font-weight: 200;
				z-index: 10000;
			}

			#all-examples-info {
				position: absolute;
				background: white;
				font-size: 16px;
				padding: 20px;
				top: 100px;
				width: 350px;
				line-height: 150%;
				border: 1px solid rgba(0, 0, 0, .2);
			}

			.title_css {

				font-size: 22px;

				margin-top: 8px;

				margin-bottom: 8px;

				font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;

				text-align: center;

				font-weight: bold;

			}
		</style>

		<link rel="stylesheet" href="heatmap_test/leaflet.css" />

		<script src="heatmap_test/leaflet.js"></script>

		<script src="heatmap_test/build/heatmap.js"></script>

		<script src="heatmap_test/plugins/leaflet-heatmap/leaflet-heatmap.js"></script>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	</head>
	<body>
		<?php include("inc/header.php"); ?>

		<div class="main_data_css">

			<div class="dashboard_heading" style="float: left;">

				<div style="float: left;">

					Heat Map: Gaylord Customers

					<div class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i>

						<span class="tooltiptext">This heat map shows the user where all B2B gaylord customers are located, counted over the lifetime of UCB.</span>
					</div>

					<div style="height: 13px;">&nbsp;</div>

				</div>

			</div>

			<?php
				db_b2b();

				$sql_z = "SELECT latitude, longitude, cnt from heatmap_gaylords_temp_tbl where report_name='heatmap_where_cust_buy_gylord'";

				$resultz = db_query($sql_z);

				$zip_data[] = array();

				while ($row_z = array_shift($resultz)) {

					$zip_data[] = $row_z;
				}

				$data_json = json_encode($zip_data);

			?>

			<div class="title_css"><strong>B2B Map to show where customers buy Gaylords</strong></div>

			<!--<h1>B2B Map to show where customers buy Gaylords</h1>-->



			<div id="map"></div>

			<div id="heatmap" name="heatmap"></div>



			<script>
				window.onload = function() {



					var testData = {

						max: 8,

						data: <?php echo $data_json; ?>
					};



					var baseLayer = L.tileLayer(

						'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {

							attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',

							maxZoom: 18

						}

					);

					//



					//

					var cfg = {

						// radius should be small ONLY if scaleRadius is true (or small radius is intended)

						"radius": 2,

						"maxOpacity": .8,

						// scales the radius based on map zoom

						"scaleRadius": true,

						// if set to false the heatmap uses the global maximum for colorization

						// if activated: uses the data maximum within the current map boundaries 

						//   (there will always be a red spot with useLocalExtremas true)

						"useLocalExtrema": true,

						// which field name in your data represents the latitude - default "lat"

						latField: 'latitude',

						// which field name in your data represents the longitude - default "lng"

						lngField: 'longitude',

						// which field name in your data represents the data value - default "value"

						valueField: 'cnt'

					};



					var heatmapLayer = new HeatmapOverlay(cfg);



					var map = new L.Map('map', {

						center: new L.LatLng(37.090240, -95.712891),

						zoom: 4,

						layers: [baseLayer, heatmapLayer]

					});



					heatmapLayer.setData(testData);



					// make accessible for debugging

					layer = heatmapLayer;

				};
			</script>



			<style>
				#no-more-tables {

					float: left;

					width: 20%;

					overflow-x: auto;

					margin-top: 20px;

					margin-bottom: 20px;

				}

				#no-more-tables table {

					width: 96%;

					margin: 0px auto;

					padding: 0;

					border-spacing: 1;

					border-collapse: collapse;

				}

				tr:nth-child(even) {

					background-color: #efefef;

				}

				tr:nth-child(odd) {

					background-color: #ffffff;

				}

				#no-more-tables table th {

					text-align: left;

					background-color: #c9c9c9;

					font-size: 16px;

					color: #4a4a4a;

					line-height: 22px;

					border-right: 1px solid #cfcfcf;

					font-weight: normal;

					padding: 11px 0px 11px 10px;

				}

				#no-more-tables table th:last-of-type {

					border-right: none;

				}

				#no-more-tables table td:last-of-type {

					border-right: none;

				}

				#no-more-tables table td {

					text-align: left;

					color: #4a4a4a;

					line-height: 22px;

					font-size: 16px;

					border-right: 1px solid #cfcfcf;

					padding: 8px 0px 8px 10px;

				}



				.text-align1 {

					text-align: center !important;

				}
			</style>



			<?php
				db();

				$sql = "SELECT variablevalue from tblvariable where variablename = 'heatmap_gaylords_cron_run_date'";

				$result = db_query($sql);

				while ($row = array_shift($result)) {

					echo "<br>Cron Job run date - " . $row["variablevalue"] . "<br>";
				}

			?>

			<div id="no-more-tables">

				<table>

					<thead>

						<th>Zip Code</th>

						<th class="text-align1">Count</th>

					</thead>

					<?php
						db_b2b();

						$sql_z = "SELECT zip, cnt from heatmap_gaylords_temp_tbl where report_name='heatmap_where_cust_buy_gylord' order by cnt desc";

						$resultz = db_query($sql_z);

						while ($row_z = array_shift($resultz)) {

							echo "<tr><td class='text-align1'>" . $row_z["zip"] . " </td>";

							echo "<td class='text-align1'>" . $row_z["cnt"] . " </td></tr>";
						}

					?>
				</table>
			</div>
		</div>
	</body>
</html>