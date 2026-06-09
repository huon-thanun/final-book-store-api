@extends('layouts.dashboard')

@section('content')
<div style="max-width:520px;">

    {{-- Page heading --}}
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('books.ui') }}" style="width:36px; height:36px; border-radius:9px; border:1px solid #e8eaf0; background:#fff; display:flex; align-items:center; justify-content:center; text-decoration:none; color:#7b7f96; font-size:14px;">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <p style="margin:0; font-size:12px; color:#7b7f96; font-weight:500; text-transform:uppercase; letter-spacing:.06em;">Categories</p>
            <h1 style="margin:0; font-size:20px; font-weight:700; color:#1a1d2e;">បង្កើតប្រភេទថ្មី</h1>
        </div>
    </div>

    <div class="card">
        <div class="card-body" style="padding:28px;">
            <form action="{{ route('categories.ui.store') }}" method="POST">
                @csrf

                {{-- Icon row --}}
                <div class="d-flex align-items-center gap-3 mb-5">
                    <div style="width:56px; height:56px; border-radius:50%; background:rgba(108,99,255,0.08); border:2px dashed rgba(108,99,255,0.25); display:flex; align-items:center; justify-content:center;">
                        <i class="fa-solid fa-tags" style="color:#6c63ff; font-size:20px;"></i>
                    </div>
                    <div>
                        <p style="margin:0; font-weight:600; font-size:14px; color:#1a1d2e;">ប្រភេទសៀវភៅ</p>
                        <p style="margin:0; font-size:13px; color:#7b7f96;">ប្រភេទនឹងបង្ហាញនៅក្នុងទំព័របញ្ជី</p>
                    </div>
                </div>

                <div style="margin-bottom:28px;">
                    <label class="form-label">ឈ្មោះប្រភេទ</label>
                    <input type="text" name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}"
                           placeholder="ឧទាហរណ៍: ប្រលោមលោក, ការអប់រំ, វិទ្យាសាស្ត្រ"
                           required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <p style="font-size:12px; color:#7b7f96; margin-top:6px; margin-bottom:0;">
                        ជ្រើសឈ្មោះខ្លី ច្បាស់លាស់ ងាយស្គាល់
                    </p>
                </div>

                <div class="d-flex gap-2 justify-content-end" style="border-top:1px solid #f0f1f5; padding-top:20px;">
                    <a href="{{ route('books.ui') }}" class="btn btn-light">
                        <i class="fa-solid fa-xmark me-1"></i>បោះបង់
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-plus me-1"></i>បង្កើតប្រភេទ
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Tip box --}}
    <div style="margin-top:16px; padding:14px 16px; background:rgba(108,99,255,0.04); border:1px solid rgba(108,99,255,0.12); border-radius:10px; display:flex; gap:10px; align-items:flex-start;">
        <i class="fa-solid fa-lightbulb" style="color:#6c63ff; font-size:14px; margin-top:2px;"></i>
        <p style="margin:0; font-size:13px; color:#5a52d5; line-height:1.6;">
            ប្រភេទដែលបង្កើតហើយ នឹងអាចជ្រើសរើសបានភ្លាមៗនៅពេលបន្ថែមសៀវភៅ
        </p>
    </div>
</div>
@endsection