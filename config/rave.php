<?php

/*
 * This file is part of the Laravel Rave package.
 *
 * (c) Oluwole Adebiyi - Flamez <flamekeed@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /**
     * Public Key: Your Rave publicKey. Sign up on https://rave.flutterwave.com/ to get one from your settings page
     *
     */
    'publicKey' => env('FLWPUBK-8def1b75286d6a5811541add0d8389b3-X'),

    /**
     * Secret Key: Your Rave secretKey. Sign up on https://rave.flutterwave.com/ to get one from your settings page
     *
     */
    'secretKey' => env('FLWSECK-dd94408b299955e21c4873cd6ed1514f-X'),

    /**
     * Company/Business/Store Name: The name of your store
     *
     */
    'title' => env('RAVE_TITLE', 'RCCG Junior Church'),

    /**
     * Environment: This can either be 'staging' or 'live'
     *
     */
    'env' => env('RAVE_ENVIRONMENT', 'live'),

    /**
     * Logo: Enter the URL of your company/business logo
     *
     */
    'logo' => env('http://rccgjuniorchurch.org/assets/img/logo.gif'),

    /**
     * Prefix: This is added to the front of your transaction reference numbers
     *
     */
    'prefix' => env('RAVE_PREFIX', 'rave-rccg'),

    /**
     * Prefix: This is added to the front of your transaction reference numbers
     *
     */
    'secretHash' => env('RAVE_SECRET_HASH', 'rccgjuniorchurch'),
];