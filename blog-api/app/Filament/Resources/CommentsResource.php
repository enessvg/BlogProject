<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentsResource\Pages;
use App\Filament\Resources\CommentsResource\RelationManagers;
use App\Models\Comments;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CommentsResource extends Resource
{
    protected static ?string $model = Comments::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    protected static ?string $navigationGroup = 'Blog';

    protected static ?int $navigationSort = 2;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('is_visible', '=', '0')->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::where('is_visible', '=', '0')->count() > 0 ? 'danger' : 'primary';
    }

    public static function form(Form $form): Form
    {
        $post = \App\Models\Post::all();

        $postOptions = $post->mapWithKeys(function ($post) {
            return [$post->id => $post->title];
        })->toArray();

        return $form
            ->schema([
                Group::make()
                ->schema([
                    Section::make('Comment Detail')
                    ->schema([
                        TextInput::make('name'),
                        TextInput::make('email'),

                        Select::make('post_id')
                        ->options($postOptions)
                        ->label('Post Name')
                        ->required()
                        // ->columnSpanFull(),
                        ,
                        Toggle::make('is_visible')
                        ->label('Visibility')
                        ->helperText('Enable or disable post visibility')
                        ->inline(false)
                        ->default(false),


                        MarkdownEditor::make('content')
                                ->label('Comment details')
                                ->columnSpan('full')
                                ->required(),

                    ])->columns(2)
                ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('post.title')
                ->label('Which post?'),

                TextColumn::make('name')
                ->label('Name Surname'),

                TextColumn::make('email')
                ->label('Email address'),

                TextColumn::make('content')
                ->label('Content')
                ->limit(100),

                IconColumn::make('is_visible')
                ->sortable()
                ->toggleable()
                ->label('Visibility')
                ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListComments::route('/'),
            'create' => Pages\CreateComments::route('/create'),
            'edit' => Pages\EditComments::route('/{record}/edit'),
        ];
    }
}
