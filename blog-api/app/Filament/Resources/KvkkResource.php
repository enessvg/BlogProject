<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KvkkResource\Pages;
use App\Filament\Resources\KvkkResource\RelationManagers;
use App\Models\Kvkk;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;


class KvkkResource extends Resource
{
    protected static ?string $model = Kvkk::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Admin';
    protected static ?string $navigationLabel = 'KVKK Text';
    protected static ?int $navigationSort = 53;



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                ->schema([
                    Section::make('KVKK Detail')
                        ->schema([
                            TextInput::make('title')
                                ->label('Title')
                                ->required()
                                ->live(onBlur: true)
                                ->unique(ignoreRecord: true)
                                ->afterStateUpdated(function(string $operation, $state, Forms\Set $set) {
                                    if ($operation !== 'create') {
                                        return;
                                    }

                                    $set('slug', Str::slug($state));
                                }),

                            TextInput::make('slug')
                                ->disabled()
                                ->dehydrated()
                                ->required(),

                            MarkdownEditor::make('description')
                                ->label('KVKK details')
                                ->columnSpan('full')
                                ->required(),
                        ])
                        ->columns(2),
                ])
                ->columnSpanFull(),//buraya kadar
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title'),
                TextColumn::make('description')->limit(100),
                TextColumn::make('updated_at')->label('Last Updated')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKvkks::route('/'),
            'create' => Pages\CreateKvkk::route('/create'),
            'edit' => Pages\EditKvkk::route('/{record}/edit'),
        ];
    }
}
