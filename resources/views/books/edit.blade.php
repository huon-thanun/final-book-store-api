<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>កែប្រែព័ត៌មានសៀវភៅ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@400;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Kantumruy Pro', sans-serif; background-color: #f4f6f9; } .form-card { background: white; border-radius: 12px; padding: 30px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); } </style>
</head>
<body>
    <div class="container py-5" style="max-width: 700px;">
        <div class="mb-3"><a href="{{ route('books.ui') }}" class="btn btn-sm btn-secondary rounded"> បោះបង់</a></div>
        
        <div class="form-card border">
            <h4 class="fw-bold text-dark mb-4">📝 កែប្រែព័ត៌មានសៀវភៅ (#{{ $book->id }})</h4>

            <form action="{{ route('books.ui.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label fw-bold">ចំណងជើងសៀវភៅ</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title', $book->title) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">រូបភាពគម្របសៀវភៅ (ជ្រើសរើសថ្មីបើចង់ប្ដូរ)</label>
                    <input type="file" class="form-control mb-2" name="cover_image">
                    
                    <div class="mt-2">
                        <small class="text-muted d-block mb-1">រូបភាពបច្ចុប្បន្ន៖</small>
                        @if($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" width="100" class="img-thumbnail" alt="Current Cover">
                        @else
                            <span class="badge bg-secondary">មិនមានរូបភាពឡើយ</span>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">ប្រភេទសៀវភៅ</label>
                        <select class="form-select" name="category_id" required>
                            @foreach($categories ?? \App\Models\Category::all() as $cat)
                                <option value="{{ $cat->id }}" {{ $book->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">អ្នកនិពន្ធ</label>
                        <select class="form-select" name="author_id" required>
                            @foreach($authors ?? \App\Models\Author::all() as $aut)
                                <option value="{{ $aut->id }}" {{ $book->author_id == $aut->id ? 'selected' : '' }}>{{ $aut->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">តម្លៃសៀវភៅ ($)</label>
                    <input type="number" step="0.01" class="form-control" name="price" value="{{ old('price', $book->price) }}" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">ការពិពណ៌នាបន្ថែម</label>
                    <textarea class="form-control" name="description" rows="3">{{ old('description', optional($book->bookDetail)->description) }}</textarea>
                </div>

                <button type="submit" class="btn btn-warning fw-bold w-100 py-2 text-dark"><i class="bi bi-arrow-clockwise"></i> ធ្វើបច្ចុប្បន្នភាពទិន្នន័យ</button>
            </form>
        </div>
    </div>
</body>
</html>