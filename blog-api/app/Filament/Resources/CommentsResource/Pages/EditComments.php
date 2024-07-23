<?php

namespace App\Filament\Resources\CommentsResource\Pages;

use App\Filament\Resources\CommentsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditComments extends EditRecord
{
    protected static string $resource = CommentsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
