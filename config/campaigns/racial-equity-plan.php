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
        'Racial Equity Plan',
        'The Racial Equity Plan',
        'the racial equity plan',
        'The Boulder Racial Equity Plan',
        'Racial History of the City of Boulder',
        'The Journey Here: The Racial Equity Plan',
        'seeking the beginnings of social justice in boulder',
        'racial equity in boulder',
        'Racial Equity in Boulder',
        'Approve the Racial Equity Plan',
        'Adopt the Racial Equity Plan',
        'Move forward on Boulder’s Racial Equity Plan',
        'Boulder has a choice on racial equity',
        'Progress Boulder’s Racial Equity Plan',
        'Boulder needs racial equity',
        'Acknowledging our past wrongs',
        'Coming to terms with Boulder’s past',
        'Racial Equity in Boulder',
        'Support the Racial Equity Plan',
        'To move forward on Racial Equity approve the REP'
    ],

    'references' => [
        ['Housing, land use policy references retained in Boulder’s racial equity plan', 'https://boulderbeat.news/2021/02/11/racial-equity-plan-zoning/'],
        ['Racial History of the City of Boulder', 'https://boulderbeat.news/wp-content/uploads/2021/02/Racial-history-Boulder.pdf'],
        ['Item 5A - Racial Equity Plan Adoption', 'https://boulder.novusagenda.com/agendapublic/AttachmentViewer.ashx?AttachmentID=3893&ItemID=3482'],
    ],

    'talking-points' => [
        'Hello I am a talking point',
        'Hello I am also a talking point',
        'I am a talking point and I think I bring some very interesting things to the table',
    ],

    'asks' => [
        'Please adopt the Racial Equity Plan',
        'Please include the critical parts about land use / racial equity',
        'Please adopt the plan and implement it through policy',
    ],
];
