JQUERY(document).ready(function()
{
 	var centre = JQUERY('#centre').height();
    var droite = JQUERY('#droite').height();

	if(droite > centre) {
	JQUERY('#centre').css('min-height', droite+8);
    }
});