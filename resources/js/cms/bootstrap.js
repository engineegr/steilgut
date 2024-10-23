window._ = require('lodash');

import $ from 'jquery';
// import { Collapse } from 'bootstrap/dist/js/bootstrap.esm.min.js';
import { Helper } from "../shared/utils/helper";

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = $;
    const temp = require('bootstrap');
    window.bootstrap = temp;
    if (!window.STEILGUT_CMS_VAR_STORE) {
        window.STEILGUT_CMS_VAR_STORE = {
            UTILS: {
                Helper,
            },
        };
    }
} catch (e) {
    console.error(e);
}


/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

const token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('Error [bootstrap.js] CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}