document.addEventListener('DOMContentLoaded', function() {
  // Set the countdown date (replace with your desired date)
  const countdownDate = new Date('March 31, 2024 00:00:00 GMT+0000').getTime();

  const countdown = setInterval(function() {
      const now = new Date().getTime();
      const distance = countdownDate - now;

      const days = Math.floor(distance / (1000 * 60 * 60 * 24));
      const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((distance % (1000 * 60)) / 1000);

      document.getElementById('days').innerText = days + 'd';
      document.getElementById('hours').innerText = hours + 'h';
      document.getElementById('minutes').innerText = minutes + 'm';
      document.getElementById('seconds').innerText = seconds + 's';

      if (distance < 0) {
          clearInterval(countdown);
          document.getElementById('days').innerText = '0d';
          document.getElementById('hours').innerText = '0h';
          document.getElementById('minutes').innerText = '0m';
          document.getElementById('seconds').innerText = '0s';
      }
  }, 1000);
});
