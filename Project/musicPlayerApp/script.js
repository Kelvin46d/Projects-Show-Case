
// Initialize variables
const audioPlayer = document.getElementById("audio-player");
const playPauseBtn = document.getElementById("play-pause-btn");
const prevBtn = document.getElementById("prev-btn");
const nextBtn = document.getElementById("next-btn");
const seekBar = document.getElementById("seek-bar");
const volumeControl = document.getElementById("volume");
const trackTitle = document.getElementById("track-title");
const trackArtist = document.getElementById("track-artist");
const currentTimeEl = document.getElementById("current-time");
const durationEl = document.getElementById("duration");
const playlistEl = document.getElementById("playlist");
const shuffleBtn = document.getElementById("shuffle-btn");
const repeatBtn = document.getElementById("repeat-btn");
const themeToggleBtn = document.getElementById("theme-toggle");

let isShuffle = false;
let isRepeat = false;

// Track List
const tracks = [
  { title: "Track 1", artist: "Artist 1", src: "Go_Beyond_Andy.mp3", lyrics: "Lyrics for Track 1" },
  { title: "Track 2", artist: "Artist 2", src: "Go_Beyond_Sonna.mp3", lyrics: "Lyrics for Track 2" },
  { title: "Track 3", artist: "Artist 3", src: "track3.mp3", lyrics: "Lyrics for Track 3" },
];




let currentTrackIndex = 0;

// Load Track
function loadTrack(index) {
  const track = tracks[index];
  if (track) {
    trackTitle.textContent = track.title;
    trackArtist.textContent = track.artist;
    audioPlayer.src = track.src;
    updatePlaylist(index);
  }
}

// Play/Pause Functionality
function togglePlayPause() {
  if (audioPlayer.paused) {
    audioPlayer.play().catch((error) => {
      console.error("Audio playback failed:", error);
    });
    playPauseBtn.textContent = "⏸";
  } else {
    audioPlayer.pause();
    playPauseBtn.textContent = "▶️";
  }
}

// Play Next Track
function playNext() {
  currentTrackIndex = isShuffle
    ? Math.floor(Math.random() * tracks.length)
    : (currentTrackIndex + 1) % tracks.length;
  loadTrack(currentTrackIndex);
  audioPlayer.play();
}

// Play Previous Track
function playPrevious() {
  currentTrackIndex = (currentTrackIndex - 1 + tracks.length) % tracks.length;
  loadTrack(currentTrackIndex);
  audioPlayer.play();
}

// Event Listeners
audioPlayer.addEventListener("ended", () => {
  if (isRepeat) {
    audioPlayer.play();
  } else {
    playNext();
  }
});

audioPlayer.addEventListener("timeupdate", () => {
  const currentTime = audioPlayer.currentTime || 0;
  const duration = audioPlayer.duration || 0;

  currentTimeEl.textContent = formatTime(currentTime);
  durationEl.textContent = formatTime(duration);
  seekBar.value = (currentTime / duration) * 100 || 0;
});

// Format Time
function formatTime(seconds) {
  const minutes = Math.floor(seconds / 60);
  const secs = Math.floor(seconds % 60);
  return `${minutes}:${secs < 10 ? "0" : ""}${secs}`;
}

// Seek Bar
seekBar.addEventListener("input", () => {
  audioPlayer.currentTime = (seekBar.value / 100) * audioPlayer.duration;
});

// Volume Control
volumeControl.addEventListener("input", () => {
  audioPlayer.volume = volumeControl.value;
});

// Load Playlist
function loadPlaylist() {
  playlistEl.innerHTML = "";
  tracks.forEach((track, index) => {
    const li = document.createElement("li");
    li.textContent = `${track.title} - ${track.artist}`;
    li.addEventListener("click", () => {
      currentTrackIndex = index;
      loadTrack(index);
      audioPlayer.play();
    });
    playlistEl.appendChild(li);
  });
}

// Update Playlist
function updatePlaylist(index) {
  playlistEl.querySelectorAll("li").forEach((item, i) => {
    item.classList.toggle("active", i === index);
  });
}

// User Interaction to Enable Audio Context
let audioContext;
function enableAudioContext() {
  if (!audioContext) {
    audioContext = new (window.AudioContext || window.webkitAudioContext)();
    const source = audioContext.createMediaElementSource(audioPlayer);
    source.connect(audioContext.destination);
  }
}
// Initialize
document.addEventListener("DOMContentLoaded", () => {
    loadTrack(currentTrackIndex); // Load the first track
    loadPlaylist(); // Load the playlist into the UI
    
    // Enable Audio Context on user interaction
    document.body.addEventListener("click", enableAudioContext, { once: true });
  
    // Restore saved theme
    const savedTheme = localStorage.getItem("theme");
    if (savedTheme === "light") {
      document.body.classList.add("light-theme");
    }
  
    // Set initial volume
    const savedVolume = localStorage.getItem("volume");
    if (savedVolume !== null) {
      volumeControl.value = savedVolume;
      audioPlayer.volume = savedVolume;
    }
    
    // Restore shuffle/repeat settings if saved
    const savedShuffle = localStorage.getItem("shuffle") === "true";
    const savedRepeat = localStorage.getItem("repeat") === "true";
    isShuffle = savedShuffle;
    isRepeat = savedRepeat;
    shuffleBtn.style.color = isShuffle ? "#00adb5" : "#fff";
    repeatBtn.style.color = isRepeat ? "#00adb5" : "#fff";
  });
  
  // Theme Toggle
  themeToggleBtn.addEventListener("click", () => {
    document.body.classList.toggle("light-theme");
    const theme = document.body.classList.contains("light-theme") ? "light" : "dark";
    localStorage.setItem("theme", theme);
  });
  
  // Shuffle Button
  shuffleBtn.addEventListener("click", () => {
    isShuffle = !isShuffle;
    shuffleBtn.style.color = isShuffle ? "#00adb5" : "#fff";
    localStorage.setItem("shuffle", isShuffle);
  });
  
  // Repeat Button
  repeatBtn.addEventListener("click", () => {
    isRepeat = !isRepeat;
    repeatBtn.style.color = isRepeat ? "#00adb5" : "#fff";
    localStorage.setItem("repeat", isRepeat);
  });
  
  // Save Volume Setting
  volumeControl.addEventListener("change", () => {
    localStorage.setItem("volume", volumeControl.value);
  });
  