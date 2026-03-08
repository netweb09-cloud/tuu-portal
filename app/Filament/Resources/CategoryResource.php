<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str; // Để dùng hàm Str::slug
use Filament\Forms\Components\TextInput; // Để dùng lớp TextInput
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Set;
use Filament\Tables\Columns\TextInputColumn; // Thêm dòng này

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label('Tên danh mục')
                ->required()
                // 1. Kích hoạt tính năng phản hồi ngay lập tức
                ->live(onBlur: true) 
                // 2. Tự động tạo slug khi tên thay đổi
                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),

            TextInput::make('slug')
                ->label('Slug (Đường dẫn)')
                ->required()
                ->unique(ignoreRecord: true)
                // Ngăn người dùng sửa nhầm nếu muốn, hoặc để trống để họ tự sửa
                ->helperText('Chuỗi này sẽ tự động được tạo từ tên.'),

            Select::make('parent_id')
                ->label('Danh mục cha')
                ->relationship('parent', 'name')
                ->placeholder('Đây là danh mục cấp cao nhất'),

            TextInput::make('order')
            ->label('Thứ tự hiển thị')
            ->numeric() // Ép kiểu số
            ->default(0) // Mặc định là 0
            ->minValue(0)
            ->helperText('Số càng nhỏ (0, 1, 2...) sẽ hiển thị càng ưu tiên trên Menu.'),

            Select::make('page_id')
            ->label('Liên kết với trang tĩnh')
            ->relationship('page', 'title') // Lấy danh sách từ bảng Page
            ->searchable()
            ->preload()
            ->helperText('Nếu chọn trang tĩnh, khi bấm vào Menu này sẽ mở trang nội dung tĩnh thay vì danh sách bài viết.'),
        ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Tên danh mục'),               
                
               
                // Hiển thị số thứ tự đã nhập từ lúc tạo
                Tables\Columns\TextColumn::make('order')
                ->label('Thứ tự')
                ->sortable() // Cho phép nhấn vào tiêu đề để sắp xếp
                ->alignCenter(), // Căn giữa cho đẹp
            

            // Thêm cột Danh mục cha tại đây
            Tables\Columns\TextColumn::make('parent.name')
                ->label('Danh mục cha')
                ->placeholder('—') // Hiện dấu gạch nếu là danh mục cấp cao nhất
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('slug')
                ->label('Đường dẫn')
                ->copyable() // Cho phép bấm vào để copy nhanh slug
                ->icon('heroicon-m-link')
                ->color('gray'),            
            
            Tables\Columns\TextColumn::make('posts_count')
                ->label('Số bài viết')
                ->counts('posts') // Tự động đếm số bài thuộc danh mục này
                ->badge(),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Ngày tạo')
                ->dateTime('d/m/Y')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true), // Ẩn bớt cho gọn, có thể bật lại
        ])
        
        ->filters([
            //
        ])
        
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
