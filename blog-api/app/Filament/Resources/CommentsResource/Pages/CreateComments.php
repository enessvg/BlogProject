<?php

namespace App\Filament\Resources\CommentsResource\Pages;

use App\Filament\Resources\CommentsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateComments extends CreateRecord
{
    protected static string $resource = CommentsResource::class;
}
