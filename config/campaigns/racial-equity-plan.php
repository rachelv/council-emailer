<?php
// until we have a database, every campaign gets a config file in this format
return [
    // active campaigns are showed in the list on the index page
    // any campaign can be accessed directly via URL whether it's active or not
    'active' => 1,

    // name of this letter writing campaign
    'title' => 'Racial Equity Plan',

    // local organization that's working on this issue
    'org-name' => 'Local Racial Equity Group',
    'org-email' => 'rachel.vecchitto@gmail.com',

    'example-subjects' => [
        'Hello I have thoughts on equity',
        'Please take my email seriously',
        'Example subject 3',
        'Example subject 4'
    ],

    'talking-points' => [
        'Hello I am a talking point',
        'Hello I am also a talking point',
        'I am a talking point and I think I bring some very interesting things to the table',
    ],
];
