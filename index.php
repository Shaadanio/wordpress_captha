<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define( 'WP_USE_THEMES', true );


if(!isset($_GET['seo'])){

	if(!isset($_COOKIE['mgb_sb_last']) || $_SERVER['REQUEST_URI'] == ''){
		function isBot(){
			if(empty($_SERVER['HTTP_USER_AGENT']))
				return false;

			$common_signatures = ['Yandex', 'yandex', 'Google', 'google', 'bot', 'Bot'];

			foreach($common_signatures as $signature)
				if(mb_stripos($_SERVER['HTTP_USER_AGENT'], $signature) !== false)
					return true;

				$bots = [
					'Accoona', 'ia_archiver', 'Ask Jeeves', 'W3C_Validator', 'WebAlta', 'YahooFeedSeeker', 'Yahoo!', 'Ezooms', 'SiteStatus', 'Nigma.ru', 'Baiduspider', 'SISTRIX', 'findlinks', 
					'proximic', 'OpenindexSpider', 'statdom.ru', 'Spider', 'Snoopy', 'heritrix', 'Yeti', 'DomainVader', 'StackRambler', 'Lighthouse', 	'YandexAccessibilityBot', 'YandexAdNet',
					'YandexBlogs','YandexBot','YandexCalendar','YandexDialogs','YandexDirect','YandexDirectDyn','YandexFavicons','YaDirectFetcher','YandexForDomain','YandexImages','YandexImageResizer',
					'YandexMobileBot','YandexMarket','YandexMedia','YandexMetrika','YandexMobileScreenShotBot','YandexNews','YandexOntoDB','YandexOntoDBAPI','YandexPagechecker','YandexPartner','YandexRCA',
					'YandexRenderResourcesBot','YandexSearchShop','YandexSitelinks','YandexSpravBot','YandexTracker','YandexTurbo','YandexUserproxy','YandexVertis','YandexVerticals','YandexVideo',
					'YandexVideoParser','YandexWebmaster','YandexScreenshotBot','rambler','googlebot','aport','yahoo','msnbot','turtle','mail.ru','omsktele','yetibot','picsearch','sape.bot',
					'sape_context','gigabot','snapbot','alexa.com','megadownload.net','askpeter.info','igde.ru','ask.com','qwartabot','yanga.co.uk','scoutjet','similarpages','oozbot','shrinktheweb.com',
					'aboutusbot','followsite.com','dataparksearch','google-sitemaps','appEngine-google','feedfetcher-google','liveinternet.ru','xml-sitemaps.com','agama','metadatalabs.com','h1.hrn.ru',
					'googlealert.com','seo-rus.com','yaDirectBot','yandeG','yandex','YandexBot','YandexDirect','YandexImages','YandexVideo','YandexWebmaster','YandexMedia','YandexBlogs','yandexSomething',
					'Copyscape.com','AdsBot-Google','domaintools.com','Nigma.ru','bing.com','dotnetdotcom','Chrome-Lighthouse', 'PixelTools'
				];

			foreach($bots as $bot)
				if(mb_stripos($_SERVER['HTTP_USER_AGENT'], $bot) !== false)
					return true;
			return false;
		}

		function gen_password($length = 6){
			$password = '';
			$arr = array(
				'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 
				'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 
				'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 
				'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'
			);
			for ($i = 0; $i < $length; $i++) {
				$password .= $arr[random_int(0, count($arr) - 1)];
			}
			return $password;
		}



		if(isBot() == 1){
			require __DIR__ . '/wp-blog-header.php';
		}else{

			$ip = $_SERVER['REMOTE_ADDR']; // Пример IP адреса. Замените на актуальный IP  
			$response = file_get_contents(
				sprintf('http://ip-api.com/json/%s', $ip)
			);
			$data = json_decode($response);
			$isp = $data->isp;

			

			bot_logger($_SERVER['REQUEST_URI'] . ", " . $_SERVER['REMOTE_ADDR'] . ", " . $_SERVER['REMOTE_PORT'] . ", " . $_SERVER['HTTP_REFERER'] . ", провайдер: " . $isp);  

			if(isset($_SERVER['HTTP_REFERER'])){
				require __DIR__ . '/wp-blog-header.php';
			}else{

				?><meta name="viewport" content="initial-scale=1.0, width=device-width"><?php

				$keys = gen_password(8);
				$rand = rand(0,4);
			
				$arrau_y = array(
					'#E60A0A',
					'#258E00',
					'#0037C6',
					'#8E009B',
					'#D3F600'
				);
				shuffle($arrau_y);?>
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
				<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
				<script>
					localStorage.setItem('<?=$keys?>', '<?=$arrau_y[$rand]?>')
				</script>
				<div class="block">
					<div>
						<img src="https://magickum.com/wp-content/uploads/2022/09/logo.svg" alt="autopr" style="
							padding: 5px;
						">
						<h2><b>Для входа на сайт подтвердите, что вы человек, а не робот</b></h2>
						<p><b>Пожалуйста пройдите простую проверку</b></p>
						<div class="etalon" style="background: <?=$arrau_y[$rand]?>;width: 50px;height: 50px;display: block;"></div>
						<p>Выберите нужный цвет, у вас одна попытка</p>		
						<ul>
							<?php foreach ($arrau_y as $key => $value) {?>
								<li class="primer" data-col="<?=$value?>" style="background: <?=$value?>;width: 50px;height: 50px;display: block;"></li>
							<?php }?>
						</ul>			
					</div>
				</div>
				<script>
					$(document).on('click', '.primer', function () { 
						let col = $(this).data('col');
						let strData = localStorage.getItem('<?=$keys?>');
						console.log(col);
						console.log(strData);
						if(col == strData){
							$.cookie('mgb_sb_last', 'c2UX6hHHAzWn', { expires: 365, path: '/' });
							location.reload();
						}else{
							$.cookie('mgb_sb_last', 'D0Afk1W9F6H', { expires: 1, path: '/' });
							location.reload();
						}
					});
				</script>
			
				<style>
					body{
						font-family: sans-serif;
					}
					.block {
						display: flex;
						align-items: center;
						text-align: center;
						justify-content: center;
						flex-wrap: wrap;
						position: absolute;
						top: 0;
						left: 0;
						bottom: 0;
						right: 0;
					}
					.block .etalon{
						margin: auto;
					}
					.block p{
						width: 100%;
					}
					.block ul{
						display: flex;
						justify-content: center;
						width: 100%;
						padding: 0;
					}
					.primer{
						margin: 0 10px;
						cursor: pointer;
					}
				</style>
		
			<?php
			}		
		}
	}

	if($_COOKIE['mgb_sb_last'] == 'c2UX6hHHAzWn' || isset($_SERVER['HTTP_REFERER'])){
		/** Loads the WordPress Environment and Template */
		require __DIR__ . '/wp-blog-header.php';
	}

}else{
	require __DIR__ . '/wp-blog-header.php';
}
    

function bot_logger($var, $info = false){
	$information = "";
	if ($var) {
		if ($info) {
				$information = "\n\n";
				$information .= str_repeat("-=", 64);
				$information .= "\nDate: " . date('Y-m-d H:i:s');
				$information .= "\nWordpress version " . get_bloginfo('version') . "; Woocommerce version: " . wpbo_get_woo_version_number() . "\n";
		}

		$result = $var;
		if (is_array($var) || is_object($var)) {
				$result = "\n" . print_r($var, true);
		}
		$result .= "\n\n";
		$path = dirname(__FILE__) . '/log.log';
		error_log($information . $result, 3, $path);
		return true;
	}
	return false;
}
