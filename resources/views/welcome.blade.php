<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Crud</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        form input, form textarea, form button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        form textarea {
            height: 80px;
            resize: none;
        }
        form button {
            background: #007bff;
            color: #ffffff;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
        }
        form button:hover {
            background: #0056b3;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
    </style>
</head>
<body>

    <form action="/products" method="POST" enctype="multipart/form-data">
        <h1>Add Product</h1>
        @csrf
        <input type="text" name="name" placeholder="Product Name" required>
        <textarea name="description" placeholder="Description"></textarea>
        <input type="number" name="price" placeholder="Price" required>
        <input type="file" name="primary_image" required>
        <input type="file" name="additional_images[]" multiple>
        <button type="submit">Save Product</button>
    </form>

</body>
</html>
