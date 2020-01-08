window.onscroll = function(){
  const nav = document.querySelector('#global-header');
	if(this.scrollY <= 650) {
		jQuery(nav).removeClass('scrollToDark');
  } else {
		jQuery(nav).addClass('scrollToDark');
	}
};