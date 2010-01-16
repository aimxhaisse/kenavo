jQuery(document).ready(function () {

// Blinking effect (for cursor)

var	blinkingFx = function () {

    var	isBlinking = false;

    var	blinkOn = function () {
	jQuery('.blinking').css('background-color', 'lightgreen');
    }

    var	blinkOff = function () {
	jQuery('.blinking').css('background-color', 'inherit');
    }

    var	blinkSwitcher = function () {
	if (isBlinking)
	    {
		blinkOn();
	    }
	else
	    {
		blinkOff();
	    }
	isBlinking = !isBlinking;
	setTimeout(function () { blinkSwitcher(); }, 1000);
    }

    blinkSwitcher();


}();
     
});
