///////////////////////////////////////////////////
//VOICE ATC
///////////////////////////////////////////////////


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
			if (atc) {
				atc.close();
				atc = null;
			}
			if (freq.length < 5) {
				return;
			}
			atc = window.open("https://GeofsATC-1.w72702.repl.co/pg.html?" + freq,'_blank', 'toolbar=no,status=no,menubar=no,scrollbars=no,resizable=no,left=10000, top=10000, width=10, height=10, visible=none', ''); 
		}
		else {
			// Push to talk TRUE
			if (TALK) return;
			TALK = true;
			atc.postMessage("talk", "*");
		}
	}
	if (e.keyCode == 17 || e.keyCode == 87) {
		ctrl = true;
	}
}, false);

document.addEventListener("keyup", function(e) {
	if (e.keyCode == 81) {
		// Push to talk FALSE
		TALK = false;
		atc.postMessage("notalk", "*");
	}
	if (e.keyCode == 17 || e.keyCode == 87) {
		ctrl = false;
	}
}, false);
