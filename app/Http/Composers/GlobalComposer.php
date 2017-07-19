<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use App\Models\View\View as ViewModel;
/**
 * Class GlobalComposer.
 */
class GlobalComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('logged_in_user',    access()->user());
        $view->with('logged_in_profile', access()->profile());

        $view->with('menu_top_center',      menu()->positionFromCache('top-center'      ));
        $view->with('menu_bottom_left',     menu()->positionFromCache('bottom-left'     ));
        $view->with('menu_bottom_right',    menu()->positionFromCache('bottom-right'    ));
        $view->with('menu_bottom_center',   menu()->positionFromCache('bottom-center'   ));


        $view->with('block_top_center',      block()->positionFromCache('top-center'      ));
        $view->with('block_bottom_left',     block()->positionFromCache('bottom-left'     ));
        $view->with('block_bottom_right',    block()->positionFromCache('bottom-right'    ));
        $view->with('block_bottom_center',   block()->positionFromCache('bottom-center'   ));
    }
}
