/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.scss in this case)
import './styles/app.scss';
import './styles/header.scss';
import './styles/footer.scss';
import './styles/form.scss';
import './styles/deals.scss';
import './styles/comment.scss';

require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');

// start the Stimulus application
import $ from 'jquery';
global.$ = global.jQuery = $;
import './bootstrap';

const routes = require('/public/js/fos_js_routes.json');
import Routing from '/vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min.js';

Routing.setRoutingData(routes);

import "./js/Vote.js";

console.log(Routing.generate('accueil'));
