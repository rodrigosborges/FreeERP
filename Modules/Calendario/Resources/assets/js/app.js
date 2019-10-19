import Echo from 'laravel-echo'

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '6ca8d531d809db01d827',
    cluster: 'us2',
    forceTLS: true
});
