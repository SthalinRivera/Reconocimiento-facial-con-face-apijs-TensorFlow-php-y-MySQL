document.getElementById('toggle-fullscreen').addEventListener('click', function() {
    const videoContainer = document.querySelector('.video-container');
    const video = document.getElementById('video');

    if (!document.fullscreenElement) {
        if (videoContainer.requestFullscreen) {
            videoContainer.requestFullscreen();
        } else if (videoContainer.mozRequestFullScreen) { // Firefox
            videoContainer.mozRequestFullScreen();
        } else if (videoContainer.webkitRequestFullscreen) { // Chrome, Safari, and Opera
            videoContainer.webkitRequestFullscreen();
        } else if (videoContainer.msRequestFullscreen) { // IE/Edge
            videoContainer.msRequestFullscreen();
        }
    } else {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.mozCancelFullScreen) { // Firefox
            document.mozCancelFullScreen();
        } else if (document.webkitExitFullscreen) { // Chrome, Safari, and Opera
            document.webkitExitFullscreen();
        } else if (document.msExitFullscreen) { // IE/Edge
            document.msExitFullscreen();
        }
    }
});

document.addEventListener('fullscreenchange', function() {
    const button = document.getElementById('toggle-fullscreen');
    if (document.fullscreenElement) {
        button.textContent = "Exit Fullscreen";
    } else {
        button.textContent = "Fullscreen";
    }
});
// Call updateTable() when the page loads
window.onload = function() {
    updateTable();
};