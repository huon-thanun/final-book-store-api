<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>កិច្ចការអនុវត្តន៍៖ ការបង្ហាញទិន្នន័យលើ UI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Kantumruy Pro', sans-serif; background-color: #f4f6f9; }
        .table-responsive { background: white; border-radius: 12px; padding: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        th { background-color: #1a1d20 !important; color: white !important; font-weight: 600; }
        td { vertical-align: middle; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="text-center mb-4">
            <h2 class="fw-bold"><i class="bi bi-table text-primary me-2"></i>កិច្ចការអនុវត្តន៍៖ ការបង្ហាញទិន្នន័យលើ UI</h2>
            <p class="text-muted small">ទម្រង់តារាង (Table Layout) រួមបញ្ចូលមុខងារគ្រប់គ្រងរូបភាពគម្របសៀវភៅពិតប្រាកដ</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success d-flex align-items-center rounded-3 mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i><div>{{ session('success') }}</div>
            </div>
        @endif

        <div class="text-end mb-3">
            <a href="{{ route('books.ui.create') }}" class="btn btn-primary fw-bold px-3 rounded-3 shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> បន្ថែមសៀវភៅថ្មី
            </a>
        </div>

        <div class="table-responsive border">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">ID</th>
                        <th style="width: 120px;">រូបភាពគម្រប</th>
                        <th>ចំណងជើងសៀវភៅ</th>
                        <th>ប្រភេទ</th>
                        <th>អ្នកនិពន្ធ</th>
                        <th>ការពិពណ៌នា / ព័ត៌មានលម្អិត</th>
                        <th class="text-end" style="width: 100px;">តម្លៃ</th>
                        <th class="text-center" style="width: 180px;">សកម្មភាព</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $book)
                        <tr>
                            <td class="text-center text-muted fw-bold">#{{ $book->id }}</td>
                            
                            <td>
                                @if($book->cover_image)
                                    <img src="{{ asset('storage/' . $book->cover_image) }}" width="80" class="rounded shadow-sm" alt="Cover" style="height: 110px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('images/default-image.png') }}" width="80" class="rounded shadow-sm" alt="Cover" style="height: 110px; object-fit: cover;">
                                @endif
                            </td>
                            
                            <td class="fw-bold text-dark">{{ $book->title }}</td>
                            <td><span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1 rounded">{{ optional($book->category)->name ?? 'មិនទាន់មាន' }}</span></td>
                            <td><span class="text-muted"><i class="bi bi-pencil-square me-1"></i>{{ $book->author }}</span></td>
                            <td>
                                <small class="text-secondary d-block text-truncate" style="max-width: 200px;">
                                    {{ optional($book->bookDetail)->description ?? 'មិនមានការពិពណ៌នា' }}
                                </small>
                            </td>
                            <td class="text-end fw-bold text-primary">${{ number_format($book->price, 2) }}</td>
                            <td class="text-center">
                                <div class="btn-group gap-1">
                                    <a href="{{ route('books.ui.show', $book->id) }}" class="btn btn-sm btn-outline-info rounded" title="មើលលម្អិត">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    
                                    <a href="{{ route('books.ui.edit', $book->id) }}" class="btn btn-sm btn-outline-warning rounded text-dark" title="កែប្រែ">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    
                                    <form action="{{ route('books.ui.destroy', $book->id) }}" method="POST" onsubmit="return confirm('តើអ្នកពិតជាចង់លុបសៀវភៅ និងរូបភាពគម្របនេះមែនទេ?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded" title="លុប">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">មិនទាន់មានទិន្នន័យសៀវភៅនៅក្នុងប្រព័ន្ធឡើយ។</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="text-muted small mt-3 text-end">ចំនួនសៀវភៅសរុប៖ <strong>{{ $books->count() }}</strong> ក្បាល</div>
    </div>
</body>
</html>