<?php header("Access-Control-Allow-Origin: *"); ?>
<html>
<head>

  <script type="text/javascript" src="//www.gstatic.com/cast/sdk/libs/caf_receiver/v3/cast_receiver_framework.js"></script>

</head>
<body>
 	
 	<cast-media-player></cast-media-player>
  	
  	<script>

  		const context = cast.framework.CastReceiverContext.getInstance();
		const playbackConfig = new cast.framework.PlaybackConfig();
		// Customize the license url for playback
		playbackConfig.licenseUrl = 'https://widevine-dash.ezdrm.com/widevine-php/widevine-foreignkey.php?pX=CA6D8D';
		playbackConfig.protectionSystem = cast.framework.ContentProtection.WIDEVINE;
		playbackConfig.licenseRequestHandler = requestInfo => {
		  requestInfo.withCredentials = false;
		};
		context.start({playbackConfig: playbackConfig});

		// Update playback config licenseUrl according to provided value in load request.
		/*context.getPlayerManager().setMediaPlaybackInfoHandler((loadRequest, playbackConfig) => {

			console.log('loadRequest', loadRequest);
		  if (loadRequest.media.customData && loadRequest.media.customData.licenseUrl) {
		    playbackConfig.licenseUrl = loadRequest.media.customData.licenseUrl;
		  }
		  return playbackConfig;
		});*/

  	</script>
</body>
</html>