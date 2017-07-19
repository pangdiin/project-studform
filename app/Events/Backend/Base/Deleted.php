<?php

namespace App\Events\Backend\Base;

use Illuminate\Queue\SerializesModels;

/**
 * Class Deleted.
 */
class Deleted
{
    use SerializesModels;

    /**
     * @var Notiffied model
     */
    public $content;

    /**
     * @var History type
     */
    public $history;

    /**
     * @param $role
     */
    public function __construct($history, $content)
    {
        $this->history  = $history;
        $this->content  = $content;
    }
}
