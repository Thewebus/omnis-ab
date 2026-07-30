<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Gestionnaires du module Rattrapage
    |--------------------------------------------------------------------------
    |
    | Emails autorisés à modifier / supprimer les notes de rattrapage.
    | Renseigner RATTRAPAGE_MANAGERS dans le .env (emails séparés par des virgules).
    | Ex : RATTRAPAGE_MANAGERS="a@ex.com,b@ex.com"
    |
    */

    'rattrapage_managers' => array_values(array_filter(array_map(
        'trim',
        explode(',', env('RATTRAPAGE_MANAGERS', 'v.bourgou2@gmail.com,youssouf.sidick.ys@outlook.com'))
    ))),

];
