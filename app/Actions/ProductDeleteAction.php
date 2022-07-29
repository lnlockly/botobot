<?php

namespace App\Actions;

use App\Catalog;
use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class ProductDeleteAction extends Action
{
    /**
     * Any title you want to be displayed
     * @var String
     * */
    public $title = "Удалить товар";

    /**
     * This should be a valid Feather icon string
     * @var String
     */
    public $icon = "";

    /**
     * Execute the action when the user clicked on the button
     *
     * @param Array $selectedModels Array with all the id of the selected models
     * @param $view Current view where the action was executed from
     */
    public function handle($selectedModels, View $view)
    {
        Catalog::whereKey($selectedModels)->delete();
    }
}
