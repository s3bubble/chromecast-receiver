<?php header("Access-Control-Allow-Origin: *"); ?>
<html>
<head>
  <script type="text/javascript"
      src="//www.gstatic.com/cast/sdk/libs/caf_receiver/v3/cast_receiver_framework.js">
  </script>

</head>
<body>
 	
 	<cast-media-player></cast-media-player>
  	
  	<script>

  		const context = cast.framework.CastReceiverContext.getInstance();
		const playbackConfig = new cast.framework.PlaybackConfig();

		playerManager.setMessageInterceptor(
            cast.framework.messages.MessageType.LOAD, loadRequestData => {
            console.log('loadRequestData', loadRequestData);
        });


		context.getPlayerManager().setMediaPlaybackInfoHandler((loadRequest, playbackConfig) => {

			console.log('loadRequest', loadRequest);

		  if (loadRequest.media.customData && loadRequest.media.customData.licenseUrl) {
		    playbackConfig.licenseUrl = loadRequest.media.customData.licenseUrl;
		  }
		  return playbackConfig;
		});
        

		// Customize the license url for playback
		playbackConfig.protectionSystem = cast.framework.ContentProtection.WIDEVINE;
		playbackConfig.licenseRequestHandler = requestInfo => {
		  requestInfo.withCredentials = true;
		  requestInfo.headers = [
		  	{
		  		"origin": ["*"],
		  		"responseHeader": ["Content-Type"],
		  		"method": ["GET", "HEAD"],
		  		"maxAgeSeconds": 86400
		  	}
		  ];
		};
		context.start({playbackConfig: playbackConfig});

  	</script>
</body>
</html>