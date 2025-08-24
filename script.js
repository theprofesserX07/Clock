// script.js
function pad(n) { return n.toString().padStart(2, '0'); }

function getGreeting(hours) {
  if (hours >= 5 && hours < 12) return 'Good Morning';
  if (hours >= 12 && hours < 17) return 'Good Afternoon';
  if (hours >= 17 && hours < 21) return 'Good Evening';
  return 'Good Night';
}

function updateClock() {
  const now = new Date();
  const h = pad(now.getHours());
  const m = pad(now.getMinutes());
  const s = pad(now.getSeconds());
  const greeting = getGreeting(now.getHours());

  const timeEl = document.getElementById('time');
  const greetEl = document.getElementById('greeting');

  if (greetEl) greetEl.textContent = greeting;
  if (timeEl) timeEl.textContent = `${h}:${m}:${s}`;
}

document.addEventListener('DOMContentLoaded', () => {
  updateClock();
  setInterval(updateClock, 1000);
});
