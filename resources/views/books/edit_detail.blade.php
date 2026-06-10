//editbookdetail
@extends('layouts.dashboard')

@section('content')
<div style="max-width:780px;">

    {{-- Page heading --}}
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('books.ui') }}" style="width:36px; height:36px; border-radius:9px; border:1px solid #e8eaf0; background:#fff; display:flex; align-items:center; justify-content:center; text-decoration:none; color:#7b7f96; font-size:14px;">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <p style="margin:0; font-size:12px; color:#7b7f96; font-weight:500; text-transform:uppercase; letter-spacing:.06em;">
                ព័ត៌មានលម្អិត
            </p>
            <h1 style="margin:0; font-size:20px; font-weight:700; color:#1a1d2e;">
                "{{ $detail->book->title }}"
            </h1>
        </div>
    </div>

    <div class="card">
        <div class="card-body" style="padding:28px;">
            <form action="{{ route('book-details.ui.update', $detail->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Section: Publication --}}
                <div style="margin-bottom:24px; padding-bottom:24px; border-bottom:1px solid #f0f1f5;">
                    <h6 style="font-size:13px; font-weight:600; color:#0ea5e9; text-transform:uppercase; letter-spacing:.06em; margin-bottom:16px;">
                        <i class="fa-solid fa-building me-1"></i> ព័ត៌មានការបោះពុម្ព
                    </h6>
                    <div class="row g-3">
                        <div class="col-md-5">
                            <label class="form-label">រោងពុម្ព / អ្នកបោះពុម្ព</label>
                            <input type="text" name="publisher" class="form-control"
                                   value="{{ old('publisher', $detail->publisher) }}"
                                   placeholder="ឧទាហរណ៍: រោងពុម្ពរស្មី" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">ភាសា</label>
                            <input type="text" name="language" class="form-control"
                                   value="{{ old('language', $detail->language) }}"
                                   placeholder="ខ្មែរ / English" required>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">ចំនួនទំព័រ</label>
                            <input type="number" name="page_count" class="form-control"
                                   value="{{ old('page_count', $detail->page_count) }}"
                                   placeholder="250" min="1" required>
                        </div>
                    </div>
                </div>

                {{-- Section: Description --}}
                <div style="margin-bottom:28px;">
                    <h6 style="font-size:13px; font-weight:600; color:#0ea5e9; text-transform:uppercase; letter-spacing:.06em; margin-bottom:16px;">
                        <i class="fa-solid fa-file-lines me-1"></i> ការពិពណ៌នាលម្អិត
                    </h6>
                    <textarea name="description" class="form-control" rows="7"
                              placeholder="សរសេរព័ត៌មានសង្ខេប ឬសាច់រឿងសង្ខេបនៃសៀវភៅ...">{{ old('description', $detail->description) }}</textarea>
                </div>

                {{-- Actions --}}
                <div class="d-flex gap-2 justify-content-end" style="border-top:1px solid #f0f1f5; padding-top:20px;">
                    <a href="{{ route('books.ui') }}" class="btn btn-light">
                        <i class="fa-solid fa-xmark me-1"></i>ត្រឡប់ទៅបញ្ជី
                    </a>
                    <button type="submit" class="btn btn-info">
                        <i class="fa-solid fa-floppy-disk me-1"></i>រក្សាទុកព័ត៌មានលម្អិត
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection