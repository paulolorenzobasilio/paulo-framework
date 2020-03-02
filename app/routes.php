<?php

return [
    ['GET', '/', ['App\Controllers\HomepageController', 'show']],
    ['GET', '/another-route', function () {
        echo 'This works too';
    }],
];
