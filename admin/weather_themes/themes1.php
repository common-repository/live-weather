<?php

$City = isset( $instance['City'] ) ? $instance['City'] : '';
$background_color = isset( $instance['color'] )? $instance['color']: '';
$text_color = isset( $instance['text_color'] )? $instance['text_color']:'';

$apiKey = "858528bcec70b3db54074be8522dd01a";
$googleApiUrl = "http://api.openweathermap.org/data/2.5/forecast?q=" . $City . "&lang=en&units=metric&APPID=" . $apiKey;

$ch = curl_init();

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
$response = curl_exec($ch);
$data = json_decode($response);

?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<div class="report-container body_th" style="background-color:<?php echo $background_color; ?> ;color:<?php echo $text_color; ?> ;">
	<div>
		<p class="weather_city_title" style="color:<?php echo $text_color; ?>!important;"><?php echo $data->city->name; ?>  </p>
	</div>
	<div>
		<div class="weather_hover">
			<h1 class="live_weather_temp" style="color: <?php echo $text_color; ?>; margin: 0px 0px;">
				<?php echo $data->list[1]->main->temp; ?>°
			</h1>
			<div class="weather_hover_effect">
				<div class="weather_hover_text" style="color:<?php echo $text_color; ?>">
					<b>Humidity : </b><span><?php echo  $data->list[1]->main->humidity ?>%</span><br>
					<b>Wind :</b><span><?php echo  $data->list[1]->main->temp_kf ?>km/h</span>
				</div>
			</div>
		</div>
	</div>
	<div class="weather_description">
		<?php echo $data->list[1]->weather[0]->description; ?>
	</div>
	<div class="weather_table">
		<table style="background-color:<?php echo $background_color; ?> ">
			<?php
			for ($i=1; $i < 6; $i++) { 		
			?>
			<tr>
				<td class="weather_table_data" style="background-color:<?php echo $background_color; ?> ;">
					<center>
						<b><?php echo date('D',strtotime($data->list[$i]->dt_txt)) ;?></b>
					</center>
				</td>
				<td class="weather_table_data" style="background-color:<?php echo $background_color; ?> ;">
					<center>
						<?php echo '<img src="'.plugins_url('\live-weather\img\themes/').''.$data->list[$i]->weather[0]->icon.'.png" width="40px" class="weather_themes1_img"">'; ?>
					</center>
				</td>
				<td class="weather_table_data" style="background-color:<?php echo $background_color; ?> ;">
					<center>
						<?php echo $data->list[$i]->main->temp_max; ?>°
					</center>
				</td>
				<td class="weather_table_data" style="background-color:<?php echo $background_color; ?> ;">
					<center>
						<?php echo $data->list[$i]->main->temp_min; ?>°
					</center>
				</td>
			</tr>
			<?php
			}
			?>
			</table>
	</div>
</div>