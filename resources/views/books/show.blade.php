<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ព័ត៌មានលម្អិត - {{ $book->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Kantumruy Pro', sans-serif; background-color: #f4f6f9; }
        .detail-card { background: #ffffff; border-radius: 16px; padding: 30px; }
        .show-cover { width: 100%; max-height: 380px; object-fit: cover; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <div class="container py-5" style="max-width: 900px;">
        <div class="mb-4">
            <a href="{{ route('books.ui') }}" class="btn btn-secondary fw-bold rounded-3">
                <i class="bi bi-arrow-left me-2"></i>ត្រឡប់ទៅបញ្ជីសៀវភៅ
            </a>
        </div>

        <div class="detail-card shadow-sm border">
            <div class="row g-4">
                <div class="col-md-4 text-center">
                    @if($book->cover_image)
                        <img src="{{ asset('storage/' . $book->cover_image) }}" class="show-cover" alt="{{ $book->title }}">
                    @else
                        <div class="bg-secondary bg-opacity-10 rounded-3 d-flex flex-column align-items-center justify-content-center text-muted border" style="height: 350px;">
                            <i class="bi bi-book display-1 mb-2 opacity-50"></i>
                            <small>មិនមានរូបភាពគម្របទេ</small>
                        </div>
                    @endif
                </div>

                <div class="col-md-8">
                    <span class="badge bg-success bg-opacity-10 text-success fw-bold px-3 py-1 rounded-pill mb-2">
                        {{ optional($book->category)->name ?? 'មិនទាន់មានប្រភេទ' }}
                    </span>
                    <h2 class="fw-bold text-dark mb-3">{{ $book->title }}</h2>
                    
                    <div class="row g-3 bg-light p-3 rounded-3 mb-4 border">
                        <div class="col-sm-6">
                            <span class="text-muted small d-block">លេខសម្គាល់សៀវភៅ</span>
                            <strong class="text-dark">#{{ $book->id }}</strong>
                        </div>
                        <div class="col-sm-6">
                            <span class="text-muted small d-block">តម្លៃលក់</span>
                            <strong class="text-primary fs-5">${{ number_format($book->price, 2) }}</strong>
                        </div>
                        <div class="col-sm-6">
                            <span class="text-muted small d-block">អ្នកនិពន្ធ</span>
                            <strong class="text-dark"><i class="bi bi-person-fill text-muted me-1"></i>{{ $book->author }}</strong>
                        </div>
                        <div class="col-sm-6">
                            <span class="text-muted small d-block">ភាសា</span>
                            <span class="badge bg-secondary px-2 py-1 rounded">{{ optional($book->bookDetail)->language ?? 'Khmer' }}</span>
                        </div>
                    </div>

                    <div class="border-top pt-3">
                        <h5 class="fw-bold text-dark mb-2"><i class="bi bi-file-earmark-text me-1 text-muted"></i>ការពិពណ៌នាសៀវភៅ</h5>
                        <div class="p-3 bg-white border rounded text-secondary" style="white-space: pre-line; min-height: 100px;">
                            {{ optional($book->bookDetail)->description ?? 'មិនមានទិន្នន័យពិពណ៌នាសម្រាប់សៀវភៅនេះឡើយ។' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>