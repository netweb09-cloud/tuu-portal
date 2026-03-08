<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Illuminate\Support\Str;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Set;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
        Forms\Components\Section::make('Nội dung bài viết')
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Tiêu đề')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),

                // Thêm ô nhập mô tả ngắn
                Forms\Components\Textarea::make('description')
                    ->label('Mô tả ngắn')
                    ->rows(3)
                    ->helperText('Phần này sẽ hiển thị in đậm ngoài trang chủ.')
                    ->required(),

                Forms\Components\RichEditor::make('content')
                    ->label('Nội dung chi tiết')
                    ->required()
                    ->columnSpanFull(),
            ])
    ]);;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            // Hiện ảnh đại diện nhỏ
            ImageColumn::make('thumbnail')
                ->label('Ảnh')
                ->disk('public')
                ->square()       // Hoặc ->circular() nếu muốn ảnh tròn
                ->size(40),      // Chỉnh kích thước hiển thị trong bảng

            // Hiện tiêu đề và cho phép tìm kiếm
            TextColumn::make('title')
                ->label('Tiêu đề')
                ->searchable()
                ->sortable()
                ->limit(50),

            // Hiện tên danh mục (Lấy từ quan hệ category)
            TextColumn::make('category.name')
                ->label('Danh mục')
                ->badge() // Làm cho đẹp giống tag
                ->color('info'),

            // Hiện trạng thái xuất bản bằng icon Check/X
            IconColumn::make('is_published')
                ->label('Đã đăng')
                ->boolean()
                ->sortable(),

            TextColumn::make('created_at')
                ->label('Ngày tạo')
                ->dateTime('d/m/Y')
                ->sortable(),
        ])
        ->filters([
            // Bạn có thể thêm bộ lọc theo danh mục tại đây sau này
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
