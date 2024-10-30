<?php

$apiKey = "858528bcec70b3db54074be8522dd01a";
$img = "https://ak2.picdn.net/shutterstock/videos/5017982/thumb/8.jpg";
$name = $city;
$cityId = $name;
$googleApiUrl = "http://api.openweathermap.org/data/2.5/forecast?q=" . $cityId . "&lang=en&units=metric&APPID=".$apiKey;

$ch = curl_init();

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
$response = curl_exec($ch);

$data = json_decode($response);

?>

<meta name="viewport" content="width=device-width, initial-scale=1">
<div class="wether_themes_3_body">
	<div class="wether_themes_3_icon_and_city">
		<div class="wether_themes_3_img">
			<?php echo '<img src="'.plugins_url('\live-weather\img\themes/').''.$data->list[1]->weather[0]->icon.'.png" width="50px" class="weather_themes2_img"">'; ?>
		</div>
		<div class="wether_themes_3_city" >
			<h1 style="color:<?php echo $text_color; ?>"><?php echo $data->city->name; ?></h1>
		</div>
		<div class="wether_themes_3_desc">
			<p style="color:<?php echo $text_color; ?>"><?php echo $data->list[1]->weather[0]->description; ?></p>
		</div>
	</div>
	<div class="wether_themes_3_today">
		<div class="wether_themes_3_temp">
			<h1 style="color: <?php echo $text_color; ?>"><?php echo $data->list[1]->main->temp; ?><sup>℉</sup></h1>
		</div>
		<div class="wether_themes_3_more_data" style="color: <?php echo $text_color; ?>">
			<p style="color: <?php echo $text_color; ?>"><span class="wether_themes_3_icon"><i class='fas fa-temperature-high'></i></span>
				<?php echo $data->list[1]->main->temp_min; ?>º - <?php echo $data->list[1]->main->temp_max; ?>º
			</p>
			<p style="color: <?php echo $text_color; ?>"><span class="wether_themes_3_icon"><i class='fas fa-cloud-rain'></i></span><?php echo $data->list[1]->main->humidity; ?>%</p>
			<p style="color: <?php echo $text_color; ?>"><span class="wether_themes_3_icon"><i class='fas fa-wind'></i></span> <?php echo $data->list[1]->main->temp_kf; ?> mph</p>
		</div>
	</div>
	<div class="wether_themes_3_day_5">

		<?php
		for ($i=0; $i < 5 ; $i++) { 
		?>
		<div class="wether_themes_3_data" style="color: <?php echo $text_color; ?>">
			<div class="wether_themes_3_icon_data">
				<?php echo '<img src="'.plugins_url('\live-weather\img\themes/').''.$data->list[$i]->weather[0]->icon.'.png" width="50px" class="weather_themes2_img"">'; ?>
			</div>
			<div class="wether_themes_3_temp_data">
				<p style="color: <?php echo $text_color; ?>"><?php echo $data->list[$i]->main->temp; ?><sup>℉</sup></p>
			</div>
			<div class="wether_themes_3_day">
				<p style="color: <?php echo $text_color; ?>"><?php echo date('D',strtotime($data->list[$i]->dt_txt)) ;?></p>
			</div>
		</div>
		<?php
		}
		?>

		<div style="clear: both;"></div>
	</div>
</div>