
function showOtpSection() {
    // Hide the inside-container
    document.querySelector('.inside-container').style.display = 'none';

    // Show the otp-container
    document.querySelector('.otp-container').style.display = 'block';
}



let timerInterval;

function showOtpSection() {
    // Hide the inside-container
    document.querySelector('.inside-container').style.display = 'none';

    // Show the otp-container
    const otpContainer = document.querySelector('.otp-container');
    otpContainer.style.display = 'block';

    // Start the timer
    startTimer(60); // 60 seconds countdown
}

function startTimer(duration) {
    const timerElement = document.getElementById('timer');
    let remainingTime = duration;

    function updateTimer() {
        const minutes = Math.floor(remainingTime / 60);
        const seconds = remainingTime % 60;
        timerElement.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        remainingTime--;

        if (remainingTime < 0) {
            clearInterval(timerInterval);
            timerElement.innerHTML = '00:00';
        }
    }

    updateTimer(); // Initial call to display the timer immediately
    timerInterval = setInterval(updateTimer, 1000); // Update every second
}