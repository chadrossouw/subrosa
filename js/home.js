(function(){
    
    let grid = document.querySelector('.grid--home');
    let homeContainer = document.querySelector('.home_scroll_container');
    let firstGridItem = document.querySelector('.grid_item:first-child');
    let lastGridItem = document.querySelector('.grid_item:last-child');
    let secondGridItem = document.querySelector('.grid_item:nth-child(2)');
    let thirdGridItem = document.querySelector('.grid_item:nth-child(3)');
    let top = document.querySelector('#top');
    let feature = document.querySelector('.feature--home');
    let topflag = false;

    document.addEventListener("DOMContentLoaded", ()=>{
        
        let firstGridTop = firstGridItem.getBoundingClientRect().top;
        let lastGridTop = lastGridItem.getBoundingClientRect().top;
        if(firstGridTop<0){
            homeContainer.classList.add('scrolled');
            homeContainer.classList.add('title_fixed');
            homeContainer.classList.add('title_fade')
        }
        if(lastGridTop<0){
            homeContainer.classList.add('ended');
        }
     });


    let observer = new IntersectionObserver(
        (entries, observer) => { 
          entries.forEach(entry => {
            if(entry.isIntersecting){
                if(entry.target == grid ){
                    homeContainer.classList.add('scrolled');
                }
                else if(entry.target == lastGridItem){
                    homeContainer.classList.add('ended');
                }
            }
          });
        }, 
        {rootMargin: "0px 0px 50px 0px"});
    observer.observe(grid);
    observer.observe(lastGridItem);

    let leavingObserver = new IntersectionObserver(
        (entries, observer) => { 
            entries.forEach(entry => {
              if(entry.isIntersecting){
                   if(entry.target == firstGridItem && !homeContainer.classList.contains('title_fixed')){
                        featureHeight = feature.clientHeight
                        homeContainer.classList.add('title_fixed');
                        homeContainer.classList.add('no_transition')
                        grid.style.paddingTop=`${featureHeight}px`;
                        topflag=true;
                   }
                   else if (entry.target == firstGridItem){
                        homeContainer.classList.remove('title_fade');
                        setTimeout(()=>{homeContainer.classList.remove('title_fixed');grid.style.paddingTop='0';},400)
                        
                   }
                   else if(entry.target == secondGridItem && !homeContainer.classList.contains('title_fade')){
                        homeContainer.classList.remove('no_transition'); 
                        homeContainer.classList.add('title_fade')
                    }
                   else if (entry.target == thirdGridItem){
                        homeContainer.classList.remove('ended');
                   }
                   else if(entry.target == top && topflag == true ){
                        homeContainer.classList.remove('scrolled');
                        homeContainer.classList.remove('no_transition'); 
                        homeContainer.classList.remove('ended');
                        homeContainer.classList.remove('title_fixed');
                        homeContainer.classList.remove('title_fade');
                        grid.style.paddingTop='0';
                        topflag=false;
                   }
                   
              }
            });
          }, 
          {rootMargin: "0px 0px -99% 0px"});
          leavingObserver.observe(firstGridItem);
          leavingObserver.observe(secondGridItem);
          leavingObserver.observe(thirdGridItem);
          leavingObserver.observe(top);
          
         // returnObserver.observe(lastGridItem);*/
})()