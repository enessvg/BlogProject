<?php

namespace App\Filament\Resources\KvkkResource\Pages;

use App\Filament\Resources\KvkkResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKvkks extends ListRecords
{
    protected static string $resource = KvkkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(), farklı bir kvkk metni yazılmaması için.
        ];
    }
}
