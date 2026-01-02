// Toggle Video Section
const toggleBtn = document.getElementById('toggleVideosBtn');
const videoSection = document.getElementById('videoSection');

toggleBtn.addEventListener('click', () => {
    videoSection.style.display = videoSection.style.display === 'none' ? 'block' : 'none';
});

// Function to stop all iframes except the one being played
function stopAllVideos(exceptIframe = null) {
    document.querySelectorAll('.video-wrapper iframe').forEach(iframe => {
        if (iframe !== exceptIframe) {
            // Reload iframe to stop playback
            const src = iframe.src;
            iframe.src = src;
        }
    });
}

// Wait for TikTok embeds to load
window.addEventListener('load', () => {
    const wrappers = document.querySelectorAll('.video-wrapper');

    wrappers.forEach(wrapper => {
        const iframe = wrapper.querySelector('iframe');
        if (iframe) {
            // Disable autoplay (if TikTok embed supports it)
            iframe.src = iframe.src.replace('autoplay=1', 'autoplay=0');

            // Listen for clicks inside the iframe to stop other videos
            iframe.addEventListener('load', () => {
                try {
                    iframe.contentWindow.document.body.addEventListener('click', () => {
                        stopAllVideos(iframe);
                    });
                } catch (e) {
                    // Some TikTok embeds prevent cross-origin access; fallback: rely on iframe click on wrapper
                    wrapper.addEventListener('click', () => {
                        stopAllVideos(iframe);
                    });
                }
            });
        }
    });
});
