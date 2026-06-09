@extends('layouts.dashboard')

@section('content')
<div style="max-width:820px;">

    {{-- Page heading --}}
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('books.ui') }}" style="width:36px; height:36px; border-radius:9px; border:1px solid #e8eaf0; background:#fff; display:flex; align-items:center; justify-content:center; text-decoration:none; color:#7b7f96; font-size:14px;">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <p style="margin:0; font-size:12px; color:#7b7f96; font-weight:500; text-transform:uppercase; letter-spacing:.06em;">Books</p>
            <h1 style="margin:0; font-size:20px; font-weight:700; color:#1a1d2e;">បញ្ចូលសៀវភៅថ្មី</h1>
        </div>
    </div>

    <div class="card">
        <div class="card-body" style="padding:28px;">
            <form action="{{ route('books.ui.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Section: Basic info --}}
                <div style="margin-bottom:24px; padding-bottom:24px; border-bottom:1px solid #f0f1f5;">
                    <h6 style="font-size:13px; font-weight:600; color:#6c63ff; text-transform:uppercase; letter-spacing:.06em; margin-bottom:16px;">
                        <i class="fa-solid fa-circle-info me-1"></i> ព័ត៌មានទូទៅ
                    </h6>
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label">ចំណងជើងសៀវភៅ</label>
                            <input type="text" name="title"
                                   class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title') }}"
                                   placeholder="បញ្ចូលចំណងជើង..." required>
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">តម្លៃ (USD)</label>
                            <div style="position:relative;">
                                <span style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#7b7f96; font-size:14px; pointer-events:none;">$</span>
                                <input type="number" step="0.01" name="price"
                                       class="form-control @error('price') is-invalid @enderror"
                                       style="padding-left:24px;"
                                       value="{{ old('price') }}"
                                       placeholder="0.00" required>
                            </div>
                            @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">ប្រភេទសៀវភៅ</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">— ជ្រើសរើសប្រភេទ —</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">អ្នកនិពន្ធ</label>
                            <select name="author_id" class="form-select" required>
                                <option value="">— ជ្រើសរើសអ្នកនិពន្ធ —</option>
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Section: Cover --}}
                <div style="margin-bottom:24px; padding-bottom:24px; border-bottom:1px solid #f0f1f5;">
                    <h6 style="font-size:13px; font-weight:600; color:#6c63ff; text-transform:uppercase; letter-spacing:.06em; margin-bottom:16px;">
                        <i class="fa-solid fa-image me-1"></i> គម្របសៀវភៅ
                    </h6>
                    <div>
                        <label class="form-label">ជ្រើសរូបភាព</label>
                        <input type="file" name="cover_image"
                               class="form-control @error('cover_image') is-invalid @enderror"
                               accept="image/*">
                        @error('cover_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <p style="font-size:12px; color:#7b7f96; margin-top:6px; margin-bottom:0;">
                            ទ្រង់ទ្រាយ: JPG, PNG — ទំហំអតិបរមា 2MB
                        </p>
                    </div>
                </div>

                {{-- Section: Description --}}
                <div style="margin-bottom:28px;">
                    <h6 style="font-size:13px; font-weight:600; color:#6c63ff; text-transform:uppercase; letter-spacing:.06em; margin-bottom:16px;">
                        <i class="fa-solid fa-file-lines me-1"></i> ការពិពណ៌នា
                    </h6>
                    <textarea name="description" class="form-control" rows="4"
                              placeholder="សរសេរការពិពណ៌នានៅទីនេះ..."></textarea>
                </div>

                {{-- Actions --}}
                <div class="d-flex gap-2 justify-content-end">
                    <a href="{{ route('books.ui') }}" class="btn btn-light">
                        <i class="fa-solid fa-xmark me-1"></i>បោះបង់
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-floppy-disk me-1"></i>រក្សាទុក
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection