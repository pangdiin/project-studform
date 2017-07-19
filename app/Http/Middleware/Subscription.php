<?php

namespace App\Http\Middleware;

use Closure;

class Subscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(access()->allow('customer-subscribe')){
            $subscription = access()->user()->subscription;
            if(!$subscription || $subscription->isExpired()){
                return redirect()->route('frontend.user.account')
                    ->withFlashDanger('It appears that your subscription has ended. Please update your subscription to proceed.');
            }
        }

        return $next($request);
    }
}
