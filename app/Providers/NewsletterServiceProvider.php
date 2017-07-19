<?php

namespace App\Providers;

use DrewM\MailChimp\MailChimp;
use Illuminate\Support\ServiceProvider;
use Spatie\Newsletter\NewsletterListCollection;
use Spatie\Newsletter\Newsletter;
class NewsletterServiceProvider extends ServiceProvider
{
    protected $defer = false;

    public function boot()
    {
        
    }

    public function register()
    {
        $this->app->singleton(Newsletter::class, function () {

            $mailChimp = new Mailchimp(setting()->key('mailchimp-api-key'));

            $mailChimp->verify_ssl = config('laravel-newsletter.ssl', true);

            $config = config('laravel-newsletter');
            $config['lists']['subscribers']['id'] = setting()->key('mailchimp-list-id');
            $configuredLists = NewsletterListCollection::createFromConfig($config);

            return new Newsletter($mailChimp, $configuredLists);
        });

        $this->app->alias(Newsletter::class, 'laravel-newsletter');
    }
}
