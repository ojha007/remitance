window.$ = window.jQuery = require('../js/Jquery')
require('./bootstrap');
require('./fastclick');
require('./AdminLTE');
require('./Jquery.slimscroll');
require('../../../node_modules/icheck');
require('../../../node_modules/select2');
require('axios');

import Echo from "laravel-echo";

window.Pusher = require('pusher-js');
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '2a143b33c6eaa5154772',
    cluster: 'ap2',
    encrypted: true
});


