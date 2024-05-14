import './bootstrap';

// Set up your Echo listener here
if (typeof window.Echo !== 'undefined') {
    window.Echo.channel('tasks')
        .listen('TaskCreated', (event) => {
            console.log('New task created:', event.task);
        });
} else {
    console.error('window.Echo is undefined. Check your bootstrap.js file.');
}
