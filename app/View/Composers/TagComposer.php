<?php

namespace App\View\Composers;


use App\Models\Tag;
use Illuminate\View\View;

class TagComposer
{


    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with('tags', Tag::query()->select('id', 'title')->distinct()->get());
    }
}
