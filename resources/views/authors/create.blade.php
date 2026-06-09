@extends('layouts.dashboard')

@section('content')
<div style="max-width:620px;">

    {{-- Page heading --}}
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('books.ui') }}" style="width:36px; height:36px; border-radius:9px; border:1px solid #e8eaf0; background:#fff; display:flex; align-items:center; justify-content:center; text-decoration:none; color:#7b7f96; font-size:14px;">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <p style="margin:0; font-size:12px; color:#7b7f96; font-weight:500; text-transform:uppercase; letter-spacing:.06em;">Authors</p>
            <h1 style="margin:0; font-size:20px; font-weight:700; color:#1a1d2e;">បន្ថែមអ្នកនិពន្ធថ្មី</h1>
        </div>
    </div>

    <div class="card">
        <div class="card-body" style="padding:28px;">
            <form action="{{ route('authors.ui.store') }}" method="POST">
                @csrf

                {{-- Avatar preview circle --}}
                <div class="d-flex align-items-center gap-3 mb-5">
                    <div style="width:56px; height:56px; border-radius:50%; background:rgba(34,197,94,0.1); border:2px dashed rgba(34,197,94,0.3); display:flex; align-items:center; justify-content:center;">
                        <i class="fa-solid fa-user-pen" style="color:#22c55e; font-size:20px;"></i>
                    </div>
                    <div>
                        <p style="margin:0; font-weight:600; font-size:14px; color:#1a1d2e;">អ្នកនិពន្ធ</p>
                        <p style="margin:0; font-size:13px; color:#7b7f96;">បញ្ចូលព័ត៌មានពេញលេញ</p>
                    </div>
                </div>

                <div style="margin-bottom:20px;">
                    <label class="form-label">ឈ្មោះអ្នកនិពន្ធ</label>
                    <input type="text" name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}"
                           placeholder="ឧទាហរណ៍: គង់ ប៊ុនឈឿន" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div style="margin-bottom:20px;">
                    <label class="form-label">អ៊ីមែល</label>
                    <div style="position:relative;">
                        <i class="fa-regular fa-envelope" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#7b7f96; font-size:14px; pointer-events:none;"></i>
                        <input type="email" name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               style="padding-left:38px;"
                               value="{{ old('email') }}"
                               placeholder="author@example.com" required>
                    </div>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div style="margin-bottom:28px;">
                    <label class="form-label">ប្រវត្តិរូបសង្ខេប <span style="color:#7b7f96; font-weight:400;">(Bio)</span></label>
                    <textarea name="bio" class="form-control" rows="4"
                              placeholder="ព័ត៌មាន ឬស្នាដៃសង្ខេបរបស់អ្នកនិពន្ធ..."></textarea>
                </div>

                <div class="d-flex gap-2 justify-content-end" style="border-top:1px solid #f0f1f5; padding-top:20px;">
                    <a href="{{ route('books.ui') }}" class="btn btn-light">
                        <i class="fa-solid fa-xmark me-1"></i>បោះបង់
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fa-solid fa-user-plus me-1"></i>រក្សាទុក
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection