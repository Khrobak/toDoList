<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class GroupFilter extends AbstractFilter
{
    public const TITLE = 'title';
    public const TAG = 'tag';

    protected function getCallbacks(): array
    {
        return [
            self::TITLE => [$this, 'title'],
            self::TAG => [$this, 'tag'],
        ];
    }

    public function title(Builder $builder, $value)
    {
        $builder->where('title', 'like', "%{$value}%");
    }

    public function tag(Builder $builder, $value)
    {
        $builder->where('tag', 'like', "%{$value}%");
    }


}
