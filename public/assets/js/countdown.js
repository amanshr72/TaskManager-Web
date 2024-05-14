document.addEventListener('DOMContentLoaded', function () {
    const countdowns = document.querySelectorAll('.countdown');

    countdowns.forEach((countdown) => {
        const startDate = new Date(countdown.dataset.start).getTime();
        const endDate = new Date(countdown.dataset.end).getTime();

        const updateCountdown = () => {
            const now = new Date().getTime();
            const distance = endDate - now;

            if (distance < 0) {
                countdown.innerHTML = 'Expired';
                countdown.style.color = 'red';
                countdown.style.fontWeight = '500'
            } else {
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                countdown.innerHTML = `${days} Day ${hours}:${minutes}:${seconds}`;
                countdown.style.color = 'green';
                countdown.style.fontWeight = '650'
            }
        };

        updateCountdown();
        setInterval(updateCountdown, 1000);
    });
});