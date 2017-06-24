<?
header("Access-Control-Allow-Origin: *");
header("X-Frame-Options: ALLOWALL");
?>
<html>
<head>
	<title>VATC</title>
	<script src="swrtc.js"></script>
	<script>
		var webrtc;
		function connectFrequency(freq) {
			if (webrtc) {
				webrtc.disconnect();
				webrtc = null;
			}
			if (freq.length < 5) {
				return;
			}
			
			var room = "geofs-freq-" + freq;
			webrtc = new SimpleWebRTC({
				// we don't do video
				localVideoEl: 'localAudio',
				remoteVideosEl: 'remoteAudios',
				autoRequestMedia: true,
				enableDataChannels: false,
				media: {
					audio: true,
					video: false
				}
			});
			webrtc.on('readyToCall', function () {
				if (room) {
					webrtc.joinRoom(room, function (err, res) {
						if (err) {
							return;
						}
						webrtc.mute();
						window.speechSynthesis.speak(new SpeechSynthesisUtterance("Connected to the new frequency"));
					});
				}
			});
		}
		if (window.location.href.split('?')[1].length > 4)
			connectFrequency(window.location.href.split('?')[1]);
		
		window.addEventListener("message", function(event) {
			if (event.data == "talk") {
				webrtc.unmute();
			}
			else if (event.data == "notalk") {
				webrtc.mute();
			}
			else if (event.data.frequency) {
				connectFrequency(event.data.frequency);
			}
		});
	</script>
	
</head>
<body>
	<audio id="localAudio" controls oncontextmenu="return false;" volume="0" disabled></audio>
	<div id="remoteAudios"></div>
</body>
</html>