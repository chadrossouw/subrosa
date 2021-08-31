//Controls Nav and Button Animations (like read more and share)

//Navigation on scroll and Hamburger
(function(){
const hamburger = document.querySelector("#hamburger");
const body = document.querySelector("body");
const masthead = document.querySelector("#masthead");
const links = document.querySelectorAll("#primary-menu a");
const searchButton = document.querySelector('.search-button');
const searchNav = document.querySelector('.nav-seach-form');
const isMobileDevice = /Mobi/i.test(window.navigator.userAgent);
const shareButton = document.querySelectorAll('.subrosa_share--button');
const shareContainer = document.querySelectorAll('.subrosa_share');

hamburger.addEventListener("click", openMenu);
links.forEach(link=>link.addEventListener("click", openMenu));

function openMenu(){
    if(masthead.classList.contains("open")){
        hamburger.classList.remove("is-active");
        masthead.classList.remove("open");
		masthead.classList.remove("search-open");
        body.classList.remove("no-scroll");   
		document.documentElement.classList.remove("no-scroll");
    }
    else{
       masthead.classList.add("open");
       body.classList.add("no-scroll");
       hamburger.classList.add("is-active");
	   document.documentElement.classList.add("no-scroll");
    }
}

//const headerwrap = document.querySelector('.site-header');
var lastScrollTop = 0;

document.addEventListener("scroll", headerslide);

function headerslide(){
	let st = window.pageYOffset || document.documentElement.scrollTop;
	if (st >= 90 && st < 120){
		body.classList.add("fixed");
	}
	else if ( st >= 120 && st <= 400) {
		body.classList.add("slideOut");
		body.classList.remove("slideInDown");
	} 
	else if (st > 400 && st<lastScrollTop){
		body.classList.add("slideOut","slideInDown");
	}
	else if (st > 400 && st>lastScrollTop){
		body.classList.remove("slideInDown");
	}
	else {
		body.classList.remove("slideInDown","slideOut","fixed");
	}
	lastScrollTop = st;
}

/*Navigation Search Bar

searchButton.addEventListener('click',(e)=>{
		masthead.classList.toggle('search-open');
})
*/
/*Share Button*/
if(isMobileDevice){
shareButton.forEach((button)=>{
	button.addEventListener('click', async (e)=>{
		const title = document.title;
		const url = document.URL;
		const data ={'url':url,'title':title};
		try {
			await navigator.share(data)
			console.log = 'Shared successfully'
		  } catch(err) {
			openShare(e);
		  }
	})
});

}
else{
	shareButton.forEach((button)=>{
		button.addEventListener('click',openShare);
		console.log(button);
	});
}

function openShare(e){
	let share = e.currentTarget.parentNode;
	share.classList.toggle("open");
	let icons = share.querySelectorAll('.subrosa_share--icon');
	icons.forEach((icon)=>{
		icon.addEventListener('click',()=>{share.classList.remove("open")});
	});
}





}());