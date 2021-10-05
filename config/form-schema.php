<?php

return [

    /*
     * One of `json` or `array`. This determines the format your form will be turned into using the `form` helper.
     */
    'default-cast' => 'json',

    /*
     * The transformer to use to generate the schema. This is specific to the UI form you're using.
     */
    'transformer' => 'portal-ui-kit',

    'components' => [

        /*
         * Anonymous types which are considered to be valid.
         */
        'valid' => [
            'VText', 'VNumber'
        ]
    ],
];
