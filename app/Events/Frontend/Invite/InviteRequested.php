<?php

namespace App\Events\Frontend\Invite;

use Illuminate\Queue\SerializesModels;

/**
 * Class InviteRequested.
 */
class InviteRequested
{
    use SerializesModels;

    /**
     * @var
     */
    public $invite;

    /**
     * @param $invite
     */
    public function __construct($invite)
    {
        $this->invite = $invite;
    }
}
