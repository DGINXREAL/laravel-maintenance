<?php
return [
    /*
     * Select the following options how we now maintenance is enabled.
     *
     * file = if inside the project root a .laravel_maintenance file present, the maintenance mode will enable
     */
    'type' => "file",



    'whitelisted_ips' => explode(",", env('LARAVEL_MAINTENANCE_WHITELIST_IPS', "127.0.0.1")),
];
