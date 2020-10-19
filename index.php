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
		playbackConfig.licenseUrl = '';
		playbackConfig.protectionSystem = cast.framework.ContentProtection.WIDEVINE;
		playbackConfig.licenseRequestHandler = requestInfo => {
		  requestInfo.withCredentials = false;
		};
		context.start({playbackConfig: playbackConfig});

		// Update playback config licenseUrl according to provided value in load request.
		context.getPlayerManager().setMediaPlaybackInfoHandler((loadRequest, playbackConfig) => {
		  	
		  	if (loadRequest.media.customData && loadRequest.media.customData.licenseUrl) {
		    	playbackConfig.licenseUrl = loadRequest.media.customData.licenseUrl;
		  	}
		  	
		  	return playbackConfig;
		
		});

  	</script>
</body>
</html>