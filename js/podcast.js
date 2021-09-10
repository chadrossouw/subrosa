(function(){
const podcasts = document.querySelectorAll('.podcast');
if(podcasts.length>0){
    const playerContainer = document.querySelector('.player_container');
    const player = SC.Widget(playerContainer.firstElementChild);
    podcasts.loaded = false;
	podcasts.forEach((podcast)=>{
        if(podcast.classList.contains('no-play')){
            return;
        }
        const playPauseButton = podcast.querySelectorAll('svg');
        const podcastId = podcast.dataset.id;
        player.bind(SC.Widget.Events.PAUSE,()=>{
            if(podcasts.loaded==podcast){
                podcast.classList.remove('playing');
                playerContainer.classList.remove('open');
            }
        })
        player.bind(SC.Widget.Events.FINISH,()=>{
            if(podcasts.loaded==podcast){
                podcast.classList.remove('playing');
                playerContainer.classList.remove('open');
            }
        }) 
        player.bind(SC.Widget.Events.PLAY,()=>{
            if(podcasts.loaded==podcast){
                podcast.classList.add('playing');
                playerContainer.classList.add('open');            
            }
            else{
                podcast.classList.remove('playing');
            }
        })
        playPauseButton.forEach(button=>button.addEventListener('click',()=>{
            if(podcasts.loaded!=podcast){
                podcast.classList.add('loading');
                player.load(podcastId,{
                    color:'#521406',
                    auto_play:false,
                });
                podcasts.loaded=podcast;
                player.bind(SC.Widget.Events.READY,()=>{
                    podcast.classList.remove('loading');
                    player.play();
                })
            }
            else{
                player.isPaused((paused)=>{ 
                    if(paused){
                        player.play();
                        
                    }
                    else{
                        player.pause();
                    }
                });
            }
        }))           
    });
}


}());

