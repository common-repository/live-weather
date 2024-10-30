<?php

$apiKey = "858528bcec70b3db54074be8522dd01a";
$img = "https://ak2.picdn.net/shutterstock/videos/5017982/thumb/8.jpg";

$googleApiUrl = "http://api.openweathermap.org/data/2.5/forecast?q=" . $city . "&lang=en&units=metric&APPID=".$apiKey;

$ch = curl_init();

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
$response = curl_exec($ch);

$data = json_decode($response);

?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<div class="body_themes" style="background-color: <?php echo $background_color; ?>;color: <?php echo $text_color; ?>">

	<div class="wether_themes_2">

		<?php  

		for ($i=0; $i <6 ; $i++) { 

		?>

		<div class="wether_themes_2_data">
			<div class="wether_themes_2_img">
				<?php echo '<img src="'.plugins_url('\live-weather\img\themes/').''.$data->list[$i]->weather[0]->icon.'.png" width="50px" class="weather_themes2_img"">'; ?>
			</div>
			<div class="wether_themes_2_text">
				<p class="wether_themes_2_day" style="color: <?php echo $text_color; ?>"><?php echo date('l',strtotime($data->list[$i]->dt_txt)) ;?></p>
				<p class="wether_themes_2_temp" style="color: <?php echo $text_color; ?>"><?php echo $data->list[$i]->main->temp; ?>°C</p>
			</div>	
		</div>

		<?php

		}

		?>

		<div style="clear: both;"></div>
	</div>

</div>