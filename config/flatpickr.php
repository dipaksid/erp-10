<?php

return [
    /**
     * The url to be used to serve css file.
     * If null, it will use the one shipped with package.
     */
    'css_url' => env('FLATPICKR_CSS_URL', 'https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/flatpickr.min.css'),

    /**
     * The url to be used to serve js file.
     * If null, it will use the one shipped with package.
     */
    'js_url' => env('FLATPICKR_JS_URL', 'https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/flatpickr.min.js'),

    /**
     * Determines if the styles shipped with the package should be used.
     * Setting it to false will remove the styling for the component.
     * The flatpickr css will be untouched.
     */
    'use_style' => env('FLATPICKR_USE_STYLE', true),
];
