document.addEventListener('visibilitychange', function () {
    setTimeout(function () {
        alert('você ficou muito tempo ausente');
    }, 60 * 60 * 1000);
});