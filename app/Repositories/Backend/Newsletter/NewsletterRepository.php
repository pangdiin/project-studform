<?php

namespace App\Repositories\Backend\Newsletter;

use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use Newsletter;
/**
 * Class NewsletterRepository.
 */
class NewsletterRepository
{
    /**
     * @param Request  $request
     *
     * @return mixed
     */
    public function getForDataTable($request)
    {
        /**
         * Note: You must return deleted_at or the User getActionButtonsAttribute won't
         * be able to differentiate what buttons to show for each row.
         */
        
        $members = Newsletter::getApi()->get('lists/' . setting()->key('mailchimp-list-id').'/members')['members'];
        return $members;
    }

    /**
     * @param Request $email
     * @param Model  $model
     *
     * @return static
     */
    public function subscribe($email, $model = null)
    {
        try {
            if(!Newsletter::hasMember($email)){
                $subscriber = Newsletter::subscribe($email);
                return $subscriber;
            }
            $this->exceptions("Email address has already been subscribed. Try another email.");

        } catch (\Exception $e) {
            // dd($e);
        }
        $this->exceptions("There was an issue in subscribing the email. Please try again.");
    }

    /**
     * @param Request $email
     * @param Model  $model
     *
     * @return static
     */
    public function resubscribe($email, $model = null)
    {
        try {

            $subscriber = Newsletter::subscribeOrUpdate($email);
            return $subscriber;
        } catch (\Exception $e) {
        }
        $this->exceptions("There was an issue in subscribing the email. Please try again.");
    }

    /**
     * @param Request $email
     * @param Model  $model
     *
     * @return static
     */
    public function unsubscribe($email, $model = null)
    {
        try {

            if(Newsletter::hasMember($email)){
                $subscriber = Newsletter::unsubscribe($email);
                return $subscriber;
            }
            $this->exceptions("There was an issue in unsubscribing the email. Please try again.");

        } catch (\Exception $e) {
        }
        $this->exceptions("There was an issue in subscribing the email. Please try again.");
    }



    /**
     * @param Model $model
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function destroy($email)
    {
        if(Newsletter::hasMember($email)){
            $unsubscribed = Newsletter::delete($email);
            return true;
        }
        $this->exceptions(trans('base.alerts.failed.messages.deleted', ['attribute' => 'Subscription #' . $email]));

    }

    /**
     * @return GeneralException
     */
    public function exceptions($label)
    {
        throw new GeneralException($label);
    }

   
}
