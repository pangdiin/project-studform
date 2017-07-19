<?php 

namespace App\Models\Inquiry;

use App\Models\Base\Base as Model;
use Illuminate\Notifications\Notifiable;

class Inquiry extends Model 
{
	use Notifiable;

    protected $table = "inquiries";

    protected $fillable = [
        'subject', 'name', 'email', 'state', 'code', 'message', 'contact_no'
    ];

    public function getEventNameAttribute()
    {
        return $this->name;
    }

    // Type , Link, Icon, Tooltip, Label

    public function actions()
    {
        return [ 
            ['type' => 'show',      'link' => route('admin.inquiry.show'   , $this)],
            ['type' => 'delete',    'link' => route('admin.inquiry.destroy', $this)],
        ];
    }

    public function routeNotificationForMail()
    {
        // return $this->email_address;
        // return 'hehe@gmail.com';
        return setting()->key('email');
    }

}

