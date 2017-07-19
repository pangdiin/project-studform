<?php

namespace App\Events\Backend\Base;

use Illuminate\Queue\SerializesModels;

/**
 * Class Restored.
 */
class Restored
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
