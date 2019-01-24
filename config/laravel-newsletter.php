<?php

return [

        /*
         * The api key of a MailChimp account. You can find yours here:
         * https://us10.admin.mailchimp.com/account/api-key-popup/
         */
        // OLD KEY e8cc9c324bb0598236430c5cae13b0d1-us20
        // MAILCHIMP_APIKEY -> 2103e295a8003dde5f5b127b9ac1867f-us7
        'apiKey' => env('MAILCHIMP_APIKEY','2103e295a8003dde5f5b127b9ac1867f-us7'),

        /*
         * When not specifying a listname in the various methods, use the list with this name
         */
        'defaultListName' => 'Web Developer',

        /*
         * Here you can define properties of the lists you want to
         * send campaigns.
         */
        'lists' => [

            /*
             * This key is used to identify this list. It can be used
             * in the various methods provided by this package.
             *
             * You can set it to any string you want and you can add
             * as many lists as you want.
             */
            'patients' => [
                'id' => 'dead1f1d86'
            ],
            'doctors' => [
                'id' => '87399f11a1'
            ],
            'healthcare' => [
                'id' => 'fdb5400c4c'
            ],
            'Web Developer' => [

                /*
                 * A mail chimp list id. Check the mailchimp docs if you don't know
                 * how to get this value:
                 * http://kb.mailchimp.com/lists/managing-subscribers/find-your-list-id
                 */
                'id' => env('MAILCHIMP_LIST_ID','db9d60e4ba'),
            ],
        ],

        /*
         * If you're having trouble with https connections, set this to false.
         */
        'ssl' => true,
];
