jQuery(setupTogglers);

function setupTogglers()
{
  var togglers = document.getElementsByClassName('toggles');
    

  for(var i = 0; i<togglers.length; i++){
  	 togglers[i].addEventListener('click', toggleComponent);
	}


}



function toggleComponent(e)
{
	var target = e.target;
	console.log(target);
	var controls = target.dataset.controls;
	
	var elem = document.getElementById(controls);
	var anime = elem.dataset.animation;
	
	
	jQuery("#overlay").toggleClass(anime+"-on");
}



