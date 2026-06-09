<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>R-BookStore | ពិភពសៀវភៅសម្រាប់អ្នក</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { 
            background-color: #f6f8fc; 
            font-family: 'Kantumruy Pro', 'Segoe UI', -apple-system, sans-serif; 
        }
        .navbar-user { background: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .book-card { border: none; border-radius: 16px; background: #fff; transition: all 0.3s ease; overflow: hidden; height: 100%; box-shadow: 0 4px 6px rgba(0,0,0,0.02); }
        .book-card:hover { transform: translateY(-6px); box-shadow: 0 12px 20px rgba(108,99,255,0.12); }
        .img-container { position: relative; background: #fafbfc; height: 260px; display: flex; align-items: center; justify-content: center; overflow: hidden; border-bottom: 1px solid #f0f1f6; }
        .book-img { height: 220px; width: 155px; object-fit: cover; border-radius: 8px; box-shadow: 0 6px 12px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-user sticky-top py-3">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary fs-4" href="#">
                <i class="fa-solid fa-book-open me-2"></i>R-BookStore
            </a>
            <div class="d-flex align-items-center gap-3">
                @auth
                    <span class="text-muted"><i class="fa-regular fa-user me-2"></i>{{ Auth::user()->name }} ({{ Auth::user()->role }})</span>
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('books.ui') }}" class="btn btn-primary btn-sm rounded-pill px-3">គ្រប់គ្រងប្រព័ន្ធ</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">ចាកចេញ</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm rounded-pill px-4 fw-semibold">
                        <i class="fa-solid fa-right-to-bracket me-1"></i> ចូលប្រើប្រាស់
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container my-4 text-center p-5 rounded-4 text-white shadow-sm" style="background: linear-gradient(135deg, #6c63ff 0%, #4a3aff 100%);">
        <h2 class="fw-bold mb-2">📚 ស្វាគមន៍មកកាន់បណ្ណាល័យឌីជីថល R-BookStore</h2>
        <p class="lead mb-0 text-white-50 fs-6">អ្នកអាចស្វែងរក និងមើលព័ត៌មានលម្អិតនៃសៀវភៅល្អៗជាច្រើននៅទីនេះ</p>
    </div>

    <div class="container mb-5">
        <div class="row g-4">
            @forelse($books as $book)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="book-card shadow-sm d-flex flex-column">
                        <div class="img-container">
                            @if($book->cover_image)
                                <img src="{{ asset('storage/' . $book->cover_image) }}" class="book-img" alt="Book Cover">
                            @else
                                <div class="book-img bg-light border d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-book fa-3x text-body-tertiary"></i>
                                </div>
                            @endif
                        </div>
                        <div class="card-body p-4 d-flex flex-column flex-grow-1">
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill mb-2 px-2 py-1 small" style="width: fit-content;">
                                {{ $book->category->name ?? 'N/A' }}
                            </span>
                            <h5 class="card-title fw-bold text-dark fs-6 text-truncate mb-1">{{ $book->title }}</h5>
                            <p class="text-muted small mb-3"><i class="fa-regular fa-user me-1"></i>{{ $book->author }}</p>
                            
                            <div class="mt-auto d-flex justify-content-between align-items-center pt-2 border-top">
                                <span class="fs-5 fw-bold text-success">${{ number_format($book->price, 2) }}</span>
                                
                                {{-- 🌟 កែប្រែពីតំណភ្ជាប់ <a> ទៅជា <button> សម្រាប់ដំណើរការ AJAX Modal --}}
                                <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 view-book-detail" data-id="{{ $book->id }}">
                                    <i class="fa-solid fa-eye me-1"></i>មើលលម្អិត
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 text-muted">
                    <i class="fa-solid fa-box-open fa-3x mb-3 text-light"></i>
                    <p class="mb-0">មិនទាន់មានសៀវភៅណាមួយត្រូវបានដាក់បង្ហាញឡើយ។</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- ================================================================= --}}
    {{-- 🌟 ផ្នែកបន្ថែម៖ BOOTSTRAP 5 MODAL STRUCTURE FOR USER DETAIL --}}
    {{-- ================================================================= --}}
    <div class="modal fade" id="bookDetailModal" tabindex="-1" aria-labelledby="bookDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.15);">
                <div class="modal-header border-0 pb-0 bg-white">
                    <h5 class="modal-title fw-bold text-dark fs-5" id="bookDetailModalLabel">ព័ត៌មានលម្អិតនៃសៀវភៅ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    {{-- ១. ផ្ទាំង Loading Spinner ពេលកំពុងទាញទិន្នន័យ --}}
                    <div class="text-center py-5" id="modalSpinner">
                        <div class="spinner-border text-primary" role="status" style="color: #6c63ff !important;"></div>
                        <p class="text-muted mt-2 small">កំពុងទាញយកព័ត៌មាន...</p>
                    </div>
                    
                    {{-- ២. រចនាសម្ព័ន្ធបង្ហាញទិន្នន័យពិតប្រាកដ (លាក់ទុកសិន d-none) --}}
                    <div class="row d-none" id="modalBookContent">
                        <div class="col-md-4 text-center mb-4 mb-md-0">
                            <img id="modalBookCover" src="" class="img-fluid" style="border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.1); max-height: 280px; width: 190px; object-fit: cover;">
                        </div>
                        <div class="col-md-8">
                            <span id="modalBookCategory" class="badge mb-2" style="background: rgba(108,99,255,0.1); color: #6c63ff; padding: 6px 14px; border-radius: 20px; font-size: 12px;"></span>
                            <h3 id="modalBookTitle" class="fw-bold text-dark mb-3" style="font-size: 22px;"></h3>
                            
                            <div class="row g-2 mb-4">
                                <div class="col-6 bg-light p-2 rounded border border-light-subtle">
                                    <span class="text-muted d-block small">តម្លៃលក់</span>
                                    <strong id="modalBookPrice" class="text-success fs-5"></strong>
                                </div>
                                <div class="col-6 bg-light p-2 rounded border border-light-subtle">
                                    <span class="text-muted d-block small">អ្នកនិពន្ធ</span>
                                    <strong id="modalBookAuthor" class="text-dark"></strong>
                                </div>
                                <div class="col-6 bg-light p-2 rounded border border-light-subtle">
                                    <span class="text-muted d-block small">ភាសា</span>
                                    <strong id="modalBookLanguage" class="text-dark"></strong>
                                </div>
                                <div class="col-6 bg-light p-2 rounded border border-light-subtle">
                                    <span class="text-muted d-block small">ចំនួនទំព័រ</span>
                                    <strong id="modalBookPages" class="text-dark"></strong>
                                </div>
                            </div>

                            <div>
                                <span class="text-muted d-block small fw-bold mb-2"><i class="fa-solid fa-file-lines me-1"></i> ការពិពណ៌នាសង្ខេប៖</span>
                                <div id="modalBookDescription" class="p-3 bg-light rounded text-muted" style="font-size: 14px; line-height: 1.6; white-space: pre-line; max-height: 160px; overflow-y: auto;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ================================================================= --}}
    {{-- 🌟 ផ្នែកបន្ថែម៖ JAVASCRIPT / AJAX CONTROLLER --}}
    {{-- ================================================================= --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.view-book-detail').on('click', function() {
            var bookId = $(this).data('id');
            
            // បើកបង្ហាញ Modal និងបើកផ្ទាំង Loading Spinner
            var myModal = new bootstrap.Modal(document.getElementById('bookDetailModal'));
            myModal.show();
            
            $('#modalSpinner').removeClass('d-none');
            $('#modalBookContent').addClass('d-none');
            
            // ហៅ AJAX ទៅកាន់ Route uiShow (ត្រូវប្រាកដថាបានកែ Method uiShow ក្នុង BookController ឱ្យបោះជា JSON រួចរាល់)
            $.ajax({
                url: '/ui/books/' + bookId, 
                type: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    // បំពេញទិន្នន័យចូលក្នុង HTML Elements
                    $('#modalBookTitle').text(response.title);
                    $('#modalBookAuthor').text(response.author);
                    $('#modalBookPrice').text('$' + parseFloat(response.price).toFixed(2));
                    
                    // បង្ហាញប្រភេទ Category
                    if(response.category) {
                        $('#modalBookCategory').text(response.category.name).show();
                    } else {
                        $('#modalBookCategory').hide();
                    }
                    
                    // បង្ហាញរូបភាព Cover
                    if(response.cover_image) {
                        $('#modalBookCover').attr('src', '/storage/' + response.cover_image);
                    } else {
                        $('#modalBookCover').attr('src', 'https://via.placeholder.com/190x280?text=No+Image');
                    }
                    
                    // បង្ហាញព័ត៌មានលម្អិតបន្ថែម (ភាសា, ចំនួនទំព័រ, ការពិពណ៌នា)
                    if(response.book_detail) {
                        $('#modalBookLanguage').text(response.book_detail.language ?? 'Khmer');
                        $('#modalBookPages').text(response.book_detail.page_count ? response.book_detail.page_count + ' ទំព័រ' : '—');
                        $('#modalBookDescription').text(response.book_detail.description ?? 'មិនមានការពិពណ៌នាសម្រាប់សៀវភៅនេះឡើយ។');
                    } else {
                        $('#modalBookLanguage').text('Khmer');
                        $('#modalBookPages').text('—');
                        $('#modalBookDescription').text('មិនមានការពិពណ៌នាសម្រាប់សៀវភៅនេះឡើយ។');
                    }
                    
                    // បិទ Loading Spinner រួចបង្ហាញព័ត៌មានពិតប្រាកដ
                    $('#modalSpinner').addClass('d-none');
                    $('#modalBookContent').removeClass('d-none');
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert('មានបញ្ហាក្នុងការទាញទិន្នន័យ សូមព្យាយាមម្តងទៀត!');
                    myModal.hide();
                }
        });
        });
    });
    </script>
</body>
</html>