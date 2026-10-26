<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Quản lý kho sách</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .form-box { border: 1px solid #ccc; padding: 15px; margin-bottom: 20px; width: 500px; }
        .form-group { margin-bottom: 10px; }
        .form-group label { display: inline-block; width: 100px; }
        input, select { padding: 5px; width: 250px; }
        button { padding: 6px 12px; cursor: pointer; }
    </style>
</head>
<body>

    <h2>Quản lý kho sách</h2>

    <!-- Form thêm sách -->
    <div class="form-box">
        <h3>Thêm sách mới</h3>
        <form action="{{ route('books.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Tên sách:</label>
                <input type="text" name="title" required>
            </div>
            <div class="form-group">
                <label>Tác giả:</label>
                <input type="text" name="author" required>
            </div>
            <div class="form-group">
                <label>Danh mục:</label>
                <select name="category_id">
                    @foreach($Categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Giá bán:</label>
                <input type="number" name="price" required>
            </div>
            <div class="form-group">
                <label>Số lượng:</label>
                <input type="number" name="quantity" required>
            </div>
            <button type="submit">Thêm sách</button>
        </form>
    </div>

    <!-- Ô tìm kiếm -->
    <div class="search-box">
        <form action="{{ route('books.index') }}" method="GET">
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Tìm theo tên sách hoặc tác giả...">
            <button type="submit">Tìm kiếm</button>
        </form>
    </div>

    <!-- Bảng danh sách sách -->
    <table>
        <tr>
            <th>ID</th>
            <th>Tên sách</th>
            <th>Tác giả</th>
            <th>Danh mục</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Thao tác</th>
        </tr>
        @foreach($Books as $book)
        <tr>
            <td>{{ $book->id }}</td>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->category->name ?? '' }}</td>
            <td>{{ $book->price }}</td>
            <td>{{ $book->quantity }}</td>
            <td>
                <button href="{{ route('books.edit', $book->id) }}">Sửa</button> |
                <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Xóa sách này?')">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

</body>
</html>
