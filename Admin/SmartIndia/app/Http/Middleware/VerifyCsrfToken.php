<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'login','add_team','register', 'list_teams','add_member','list_members','list_topics','add_topics','select_team_topic','add_feedback','list_notifications','push_image','member_login','register_notifications','unregister_notifications'
    ];
    
}
