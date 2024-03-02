<?php
$soundPath = "/TImeBloom/sound/";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="index.css" />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <title>HOME</title>
  </head>

  <body>
    <nav>
      <div class="leftside-nav">
        <img src="./public/webapp-logo.png" class="logo" />
        <a href="./todo.php"><i class="bx bx-menu"></i></a>
      </div>
      <input type="button" class="logout" onclick="window.location.href='logout.php'" value="logout">
    </nav>
    <main>
      <section class="top">
        <span>30 MIN</span>
        <h2>Let's start</h2>
      </section>
      <section class="flowerbox">
        <a href="./index3.php"><i class="bx bxs-left-arrow"></i></a>
        <div class="meshpic">
          <img src="./public/t1.gif" class="flower" />
          <img src="./public/island.png" class="island" />
        </div>
        <a href="./index2.php"><i class="bx bxs-right-arrow"></i></a>
      </section>
      <button class="start-stop" id="END">START</button>
    </main>
    <footer>
      <section class="bottom">
        <img src="./public/m1.gif" class="musicpic" />
        <div class="music">
          <span class="playing"
            >Now playing : <span class="song-name"></span
          ></span>
          <div class="controls">
            <button class="btn previous">
              <i class="ph-bold ph-skip-back"></i>
            </button>
            <button class="btn play-pause">
              <i id="play-pause-icon" class="ph-bold ph-play"></i>
            </button>
            <button class="btn next">
              <i class="ph-bold ph-skip-forward"></i>
            </button>
          </div>
        </div>
      </section>
    </footer>

    <script>
      let timer;
      let isTimerRunning = false;
      let remainingTime = 1800; // 1 hour in seconds
      const flowerImg = document.querySelector(".flower");

      function toggleTimer() {
        const button = document.querySelector(".start-stop");
        const timerDisplay = document.querySelector("h2");

        if (isTimerRunning) {
          clearInterval(timer);
          button.textContent = "START";
          isTimerRunning = false;
          remainingTime = 1800;
          timerDisplay.textContent = "Let's start";
          flowerImg.src = "./public/t1.gif"; //fade 1
          window.location.href = "./index.php";
        } else {
          if (timerDisplay.textContent === "Good job!") {
            // Reset everything when END is clicked   
            button.textContent = "END";
            isTimerRunning = false;
            remainingTime = 1800;
            timerDisplay.textContent = "Let's start";
            flowerImg.src = "./public/t1.gif"; //fade 1
            
          } else {
            button.textContent = "EXIT";
            isTimerRunning = true;
            timer = setInterval(updateTimer, 1000);
          }
        }
      }

      function updateTimer() {
        const timerDisplay = document.querySelector("h2");
        const flowerImg = document.querySelector(".flower");
        const button = document.querySelector(".start-stop");
        const hours = Math.floor(remainingTime / 3600);
        const minutes = Math.floor((remainingTime % 3600) / 60);
        const seconds = remainingTime % 60;

        // Format the time to display in HH:MM format
        const formattedTime = `${formatTime(minutes)}:${formatTime(seconds)}`;

        timerDisplay.textContent = formattedTime;

        if (remainingTime <= 0) {
          // toggleTimer();
          timerDisplay.textContent = "Good job!";
        } else {
          remainingTime--;

          // Check if 5 seconds have passed and the image hasn't changed yet
          if (remainingTime === 1020) {
            flowerImg.classList.add("changed");
            flowerImg.src = "./public/t2.gif"; //fade2
          } else if (remainingTime === 5) {
            flowerImg.classList.add("changed");
            flowerImg.src = "./public/t3.gif"; //fade 3
          } else if (remainingTime === 0) {
            timerDisplay.textContent = "Good job!";
            button.textContent = "END";
          }
        }
      }

      function formatTime(time) {
        return time < 10 ? `0${time}` : time;
      }

      // Ensure the script runs after the DOM is fully loaded
      document.addEventListener("DOMContentLoaded", () => {
        document
          .querySelector(".start-stop")
          .addEventListener("click", toggleTimer);
      });

      //--------------->> music script

      
const lofi = new Audio('<?php echo $soundPath; ?>lofi.mp3');
const chill = new Audio('<?php echo $soundPath; ?>chill.mp3');
const chill2 = new Audio('<?php echo $soundPath; ?>chill2.mp3');
const miles = new Audio('<?php echo $soundPath; ?>miles.mp3');
const study = new Audio('<?php echo $soundPath; ?>study.mp3');

// selecting elements
const prevBtn = document.querySelector('.previous');
const playBtn = document.querySelector('.play-pause');
const nextBtn = document.querySelector('.next');
const songName = document.querySelector('.song-name');
const playPauseIcon = document.querySelector('#play-pause-icon');


const songs = [
  { ele: lofi, audioName: 'lofi' },
  { ele: chill, audioName: 'chill' },
  { ele: chill2, audioName: 'chill2' },
  { ele: miles, audioName: 'miles' },
  { ele: study, audioName: 'study' },
];

const songImages = [
  "./public/m1.gif",
  "./public/m2.gif",
  "./public/m3.gif",
  "./public/m4.gif",
  "./public/m5.gif",
];

for(const song of songs) {
  song.ele.addEventListener('ended', ()=> {
    updateSong('next');
    playPauseSong();
  })
}

let current = 0;
let currentSong = songs[current].ele;
songName.textContent = songs[current].audioName;

playBtn.addEventListener('click',()=> {
  playPauseSong();
})

nextBtn.addEventListener('click', () => {
  updateSong('next');
  playPauseSong();
});

prevBtn.addEventListener('click', () => {
  updateSong('prev');
  playPauseSong();
});

const updateSong = (action) => {
  currentSong.pause();
  currentSong.currentTime = 0;

  if (action === 'next') {
    current++;
    if (current > songs.length - 1) current = 0;
  }
  if (action === 'prev') {
    current--;
    if (current < 0) current = songs.length - 1;
  }
  currentSong = songs[current].ele;
  songName.textContent = songs[current].audioName;

  // Update the musicpic image source
  const musicPic = document.querySelector('.musicpic');
  musicPic.src = songImages[current];
};


const playPauseSong = ()=> {
  if(currentSong.paused){
    currentSong.play();
    playPauseIcon.className = 'ph-bold ph-pause';
  }
  else {
    currentSong.pause();
    playPauseIcon.className = 'ph-bold ph-play';
  }
}
    </script>
  </body>
</html>
