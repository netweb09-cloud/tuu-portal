<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Set;
use Illuminate\Support\Str; // Để dùng hàm Str::slug
use Filament\Tables\Columns\IconColumn;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Nội dung trang tĩnh')
                ->schema([
                    TextInput::make('title')
                        ->label('Tiêu đề trang')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                    
                    TextInput::make('slug')->required()->unique(ignoreRecord: true),
                    
                    RichEditor::make('content') // Dùng RichEditor để soạn thảo nội dung
                        ->label('Nội dung chi tiết')
                        ->required()
                        ->columnSpanFull(),
                    
                    Toggle::make('is_active')->label('Hiển thị')->default(true),
                ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // 1. Hiển thị Tiêu đề trang
                TextColumn::make('title')
                    ->label('Tiêu đề trang')
                    ->searchable() // Cho phép tìm kiếm theo tên trang
                    ->sortable(),

                // 2. Hiển thị Slug (Đường dẫn)
                TextColumn::make('slug')
                    ->label('Đường dẫn (Slug)')
                    ->icon('heroicon-o-link') // Thêm icon cho đẹp
                    ->color('gray'),

                // 3. Hiển thị trạng thái Bật/Tắt bằng icon
                IconColumn::make('is_active')
                    ->label('Hiển thị')
                    ->boolean() // Tự động chuyển true/false thành icon check/x
                    ->sortable(),

                // 4. Hiển thị ngày cập nhật cuối cùng
                TextColumn::make('updated_at')
                    ->label('Cập nhật lần cuối')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true), // Mặc định ẩn, có thể bật lên
            ])
            ->filters([
                // Có thể thêm bộ lọc trạng thái tại đây
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Trạng thái hiển thị'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }

    protected static ?string $navigationLabel = 'Pages';
    protected static ?string $pluralModelLabel = 'Pages';
    protected static ?string $modelLabel = 'Pages';
}
