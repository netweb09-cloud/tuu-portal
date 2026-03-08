<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SliderResource\Pages;
use App\Filament\Resources\SliderResource\RelationManagers;
use App\Models\Slider;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Grid;

class SliderResource extends Resource
{
    protected static ?string $model = Slider::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Cấu hình Slider')
                ->schema([
                    Forms\Components\FileUpload::make('image_path')
                        ->label('Hình ảnh')
                        ->image()
                        ->required(),
                    
                    Forms\Components\TextInput::make('title')
                        ->label('Tiêu đề Slider'),

                    // Thêm nút bật tắt tiêu đề
                    Forms\Components\Toggle::make('show_title')
                        ->label('Hiển thị tiêu đề trên ảnh')
                        ->default(true)
                        ->helperText('Bật để hiện dòng chữ tiêu đề trên Slider ngoài trang chủ'),

                    Forms\Components\TextInput::make('link')->label('Liên kết'),
                    Forms\Components\TextInput::make('order')->label('Thứ tự')->numeric(),
                    Forms\Components\Toggle::make('is_active')->label('Kích hoạt')->default(true),
                ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Ảnh Slider')
                    ->disk('public'), // Hiển thị thumbnail ảnh trong list

                Tables\Columns\TextColumn::make('title')
                    ->label('Tiêu đề')
                    ->searchable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Hiển thị')
                    ->boolean(),

                Tables\Columns\TextColumn::make('order')
                    ->label('Thứ tự')
                    ->sortable(),
            ])
            ->defaultSort('order', 'asc') // Ưu tiên hiện theo thứ tự bạn sắp xếp
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListSliders::route('/'),
            'create' => Pages\CreateSlider::route('/create'),
            'edit' => Pages\EditSlider::route('/{record}/edit'),
        ];
    }
}
