/**
 * Initializes FLickity Carousel on Home Page
 */
var elem = document.querySelectorAll('.secret_history_carousel');
elem.forEach((element)=>{
  if(element.classList.contains('secret_history_carousel--recently_viewed')){
    var cellAlign = 'left';
  }
  else{
    var cellAlign = 'center';
  }
  var flkty = new Flickity( element, {
    // options
    wrapAround: true,
    autoPlay: false,
    pageDots: true,
    freeScroll: false,
    imagesLoaded: true,
    selectedAttraction: 0.01,
    friction: 0.2,
    cellAlign: cellAlign,
    groupCells:true
  });
  }
)