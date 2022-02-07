<html>
<head>
	<title>FlightSim w/ ATC</title>
	<script>
	(function(){
		var ctrl = false;
		var atc;
		var TALK = false;
		//var htmltoadd = '<iframe src="pg.html" style="display: none" id="webATC" onload=\'window.atc = document.getElementById("webATC");\'></iframe>';
		//document.documentElement.innerHTML += htmltoadd;
		document.addEventListener("keydown", function(e) {
			if (e.keyCode == 81) {
				if (ctrl) {
					ctrl = false;
					var freq = prompt("Enter frequency:");
					atc = window.open("https://GeofsATC-1.w72702.repl.co/pg.php?" + freq,'_blank', 'toolbar=no,status=no,menubar=no,scrollbars=no,resizable=no,left=10000, top=10000, width=10, height=10, visible=none', ''); 
				}
				else {
					// Push to talk TRUE
					if (TALK) return;
					TALK = true;
					atc.contentWindow.postMessage("talk", "*");
				}
			}
			if (e.keyCode == 17) {
				ctrl = true;
			}
		}, false);
		document.addEventListener("keyup", function(e) {
			if (e.keyCode == 81) {
				// Push to talk FALSE
				TALK = false;
				atc.contentWindow.postMessage("notalk", "*");
			}
			if (e.keyCode == 17) {
				ctrl = false;
			}
		}, false);
	})();
	</script>
</head>
<body>
	
</body>
</html>
