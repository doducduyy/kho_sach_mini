<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sửa thông tin sách</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        .form-box { border: 1px solid #ccc; padding: 15px; width: 500px; }
        .form-group { margin-bottom: 10px; }
        .form-group label { display: inline-block; width: 100px; }
        input, select { padding: 5px; width: 250px; }
        button { padding: 6px 12px; cursor: pointer; }
    </style>
</head>
<body>

    <h2>Sửa thông tin sách</h2>

    <div class="form-box">
        <form action="{{ route('books.update', $book->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Tên sách:</label>
                <input type="text" name="title" value="{{ $book->title }}" required>
            </div>
            <div class="form-group">
                <label>Tác giả:</label>
                <input type="text" name="author" value="{{ $book->author }}" required>
            </div>
            <div class="form-group">
                <label>Danh mục:</label>
                <select name="category_id">
                    @foreach($Categories as $cat)
                        <option value="{{ $cat->id }}" {{ $book->category_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Giá bán:</label>
                <input type="number" name="price" value="{{ $book->price }}" required>
            </div>
            <div class="form-group">
                <label>Số lượng:</label>
                <input type="number" name="quantity" value="{{ $book->quantity }}" required>
            </div>
            <button type="submit">Lưu lại</button>
            <a href="{{ route('books.index') }}">Hủy</a>
        </form>
    </div>

</body>
</html>
