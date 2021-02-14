<?php
// until we have a database, every campaign gets a config file in this format
return [
    // active campaigns are showed in the list on the index page
    // any campaign can be accessed directly via URL whether it's active or not
    'active' => 0,

    // name of this letter writing campaign
    'title' => 'Example Campaign',

    // local organizations working on this issue
    'local-orgs' => [
        ['Org Name', 'org-email@gmail.com', 'https://www.org-website.com/'],
    ],

    'example-subjects' => [
        'Example subject 1',
        'Example subject 2',
        'Example subject 3',
        'Example subject 4',
        'Example subject 5',
        'Example subject 6',
    ],

    'references' => [],

    'talking-points' => [
        'Talking point 1',
        'Talking point 2',
        'Talking point 3',
    ],

    'asks' => [],
];
