<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('User Count', User::count())
            ->description('Number of all users')
            ->descriptionIcon('heroicon-o-user-group',IconPosition::Before)
            ,

            Stat::make('Category Count', Category::count())
            ->description('Number of all category')
            ->descriptionIcon('heroicon-c-list-bullet',IconPosition::Before),

            Stat::make('Post Count', Post::count())
            ->description('Number of all Post')
            ->descriptionIcon('heroicon-o-rectangle-stack',IconPosition::Before),
        ];
    }
}
