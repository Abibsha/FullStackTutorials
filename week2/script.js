document.addEventListener('DOMContentLoaded', () => {
  const video = document.getElementById('hero-video');
  const videoBtn = document.getElementById('toggle-video');

  function playPauseVideo(){
    if (video.paused) {
      video.play();
      videoBtn.textContent = 'Pause Video';
    } else {
      video.pause();
      videoBtn.textContent = 'Play Video';
    }
  };

  videoBtn.addEventListener('click',playPauseVideo);

  const audioBtn = document.getElementById('toggle-audio');
  const audio = document.getElementById('sample-audio');

  audioBtn.addEventListener('click',()=>{
    if(audio.paused){
      audio.paly();
      audioBtn.textContent = 'Pause Audio';
    }else{
      audio.pause();
      audioBtn.textContent = 'Pause Audio';
    }
  });

  // Handle Audio Play/Pause Here

  const canvas = document.getElementById('drawing-canvas');
  const ctx = canvas.getContext('2d');
  let isDrawing = false;
  let currentColor = '#000000';

  document.querySelectorAll('.color-picker button').forEach(btn => {
    btn.addEventListener('click', (e) => {
      currentColor = e.target.dataset.color;
      ctx.strokeStyle = currentColor;
    });
  });

  canvas.addEventListener('mousedown', (e) => {
    isDrawing = true;
    ctx.beginPath();
    ctx.moveTo(e.offsetX, e.offsetY);
  });

  canvas.addEventListener('mousemove', (e) => {
    if (isDrawing) {
      ctx.lineWidth = 6;
      ctx.lineCap = 'round';
      ctx.strokeStyle = currentColor;
      ctx.lineTo(e.offsetX, e.offsetY);
      ctx.stroke();
    }
  });

  canvas.addEventListener('mouseup', () => isDrawing = false);
  canvas.addEventListener('mouseout', () => isDrawing = false);


  document.getElementById('clear-canvas').addEventListener('click', () => {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
  });

  let cardCount = 7;
  // Add Card when Button is Pressed
  const addCartBtn = document.getElementById('add-card');

  addCartBtn.addEventListener('click', ()=> {
    const gridContainer = document.querySelector('.grid-contain');
    const newCard = document.createElement('div');
    newCard.innerHTML = 'Card' ${cardCount} <small>New Card Added</small>
    gridConatiner.appendChild(newCard);
  })
});




