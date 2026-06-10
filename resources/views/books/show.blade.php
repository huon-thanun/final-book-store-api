//showbook
@extends('layouts.dashboard')

@section('content')

{{-- Page heading --}}
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('books.ui') }}" style="width:36px; height:36px; border-radius:9px; border:1px solid #e8eaf0; background:#fff; display:flex; align-items:center; justify-content:center; text-decoration:none; color:#7b7f96; font-size:14px;">
        <i class="fa-solid fa-arrow-left"></i>
    </a>
    <div>
        <p style="margin:0; font-size:12px; color:#7b7f96; font-weight:500; text-transform:uppercase; letter-spacing:.06em;">Books / ព័ត៌មានលម្អិត</p>
        <h1 style="margin:0; font-size:20px; font-weight:700; color:#1a1d2e;">{{ $book->title }}</h1>
    </div>
</div>

<div style="max-width:900px;">
    <div class="card" style="overflow:hidden;">
        <div class="row g-0" style="min-height:480px;">

            {{-- ── Cover column ── --}}
            <div class="col-md-4" style="background:#fafbfc; border-right:1px solid #e8eaf0; display:flex; flex-direction:column; align-items:center; justify-content:center; padding:36px 24px; gap:20px;">

                @if($book->cover_image)
                    <img src="{{ asset('storage/' . $book->cover_image) }}"
                         style="width:100%; max-width:200px; border-radius:10px; border:1px solid #e8eaf0; box-shadow:0 8px 28px rgba(0,0,0,0.09);"
                         alt="{{ $book->title }}">
                @else
                    <div style="width:180px; height:240px; background:#f0f1f5; border:1px dashed #d0d3e0; border-radius:10px; display:flex; flex-direction:column; align-items:center; justify-content:center; gap:8px; color:#b0b4c8;">
                        <i class="fa-solid fa-book" style="font-size:32px;"></i>
                        <span style="font-size:13px;">មិនមានរូបភាព</span>
                    </div>
                @endif

                {{-- ID badge --}}
                <div style="text-align:center;">
                    <p style="margin:0; font-size:11px; color:#b0b4c8; font-weight:600; text-transform:uppercase; letter-spacing:.06em;">Book ID</p>
                    <p style="margin:4px 0 0; font-size:15px; font-weight:700; color:#7b7f96;">#{{ $book->id }}</p>
                </div>

                {{-- Quick actions --}}
                @if(auth()->user()->role === 'admin')
                    <div class="d-flex gap-2">
                        <a href="{{ route('books.ui.edit', $book->id) }}"
                        style="height:34px; padding:0 14px; border-radius:8px; border:1px solid #fde68a; background:#fffbeb; color:#d97706; display:inline-flex; align-items:center; gap:6px; font-size:13px; font-weight:600; text-decoration:none; font-family:'Kantumruy Pro',sans-serif;">
                            <i class="fa-solid fa-pen-to-square" style="font-size:12px;"></i>
                            <span>កែប្រែ</span>
                        </a>
                        <a href="{{ route('book-details.ui.edit', $book->id) }}"
                        style="height:34px; padding:0 14px; border-radius:8px; border:1px solid #bfdbfe; background:#eff6ff; color:#2563eb; display:inline-flex; align-items:center; gap:6px; font-size:13px; font-weight:600; text-decoration:none; font-family:'Kantumruy Pro',sans-serif;">
                            <i class="fa-solid fa-circle-info" style="font-size:12px;"></i>
                            <span>លម្អិត</span>
                        </a>
                    </div>
                @endif
            </div>

            {{-- ── Info column ── --}}
            <div class="col-md-8" style="padding:36px 32px; display:flex; flex-direction:column; gap:0;">

                {{-- Category badge --}}
                <div style="margin-bottom:12px;">
                    <span style="display:inline-flex; align-items:center; gap:5px; background:rgba(108,99,255,0.08); color:#5a52d5; font-size:12px; font-weight:600; padding:5px 12px; border-radius:20px; border:1px solid rgba(108,99,255,0.15);">
                        <i class="fa-solid fa-tag" style="font-size:10px;"></i>
                        {{ optional($book->category)->name ?? 'មិនទាន់មានប្រភេទ' }}
                    </span>
                </div>

                {{-- Title --}}
                <h2 style="font-size:24px; font-weight:700; color:#1a1d2e; line-height:1.35; margin:0 0 28px;">{{ $book->title }}</h2>

                {{-- Meta grid --}}
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:1px; background:#e8eaf0; border-radius:10px; overflow:hidden; margin-bottom:28px;">
                    <div style="background:#fafbfc; padding:14px 16px;">
                        <p style="margin:0 0 4px; font-size:11px; color:#7b7f96; font-weight:600; text-transform:uppercase; letter-spacing:.05em;">តម្លៃលក់</p>
                        <p style="margin:0; font-size:22px; font-weight:700; color:#22c55e;">${{ number_format($book->price, 2) }}</p>
                    </div>
                    <div style="background:#fafbfc; padding:14px 16px;">
                        <p style="margin:0 0 4px; font-size:11px; color:#7b7f96; font-weight:600; text-transform:uppercase; letter-spacing:.05em;">ភាសា</p>
                        <p style="margin:0; font-size:15px; font-weight:600; color:#1a1d2e;">{{ optional($book->bookDetail)->language ?? 'Khmer' }}</p>
                    </div>
                    <div style="background:#fafbfc; padding:14px 16px;">
                        <p style="margin:0 0 4px; font-size:11px; color:#7b7f96; font-weight:600; text-transform:uppercase; letter-spacing:.05em;">អ្នកនិពន្ធ</p>
                        <p style="margin:0; font-size:15px; font-weight:600; color:#1a1d2e;">
                            <i class="fa-regular fa-user me-1" style="font-size:12px; color:#7b7f96;"></i>
                            {{ $book->author }}
                        </p>
                    </div>
                    <div style="background:#fafbfc; padding:14px 16px;">
                        <p style="margin:0 0 4px; font-size:11px; color:#7b7f96; font-weight:600; text-transform:uppercase; letter-spacing:.05em;">ចំនួនទំព័រ</p>
                        <p style="margin:0; font-size:15px; font-weight:600; color:#1a1d2e;">
                            {{ optional($book->bookDetail)->page_count
                                ? number_format($book->bookDetail->page_count) . ' ទំព័រ'
                                : '—' }}
                        </p>
                    </div>
                    <div style="background:#fafbfc; padding:14px 16px;">
                        <p style="margin:0 0 4px; font-size:11px; color:#7b7f96; font-weight:600; text-transform:uppercase; letter-spacing:.05em;">អ្នកបោះពុម្ព</p>
                        <p style="margin:0; font-size:15px; font-weight:600; color:#1a1d2e;">
                            {{ optional($book->bookDetail)->publisher ?? '—' }}
                        </p>
                    </div>
                    <div style="background:#fafbfc; padding:14px 16px;">
                        <p style="margin:0 0 4px; font-size:11px; color:#7b7f96; font-weight:600; text-transform:uppercase; letter-spacing:.05em;">បន្ថែមនៅ</p>
                        <p style="margin:0; font-size:15px; font-weight:600; color:#1a1d2e;">
                            {{ $book->created_at ? $book->created_at->format('d M, Y') : '—' }}
                        </p>
                    </div>
                </div>

                {{-- Description --}}
                <div style="border-top:1px solid #f0f1f5; padding-top:22px; flex:1;">
                    <p style="margin:0 0 10px; font-size:12px; font-weight:600; color:#7b7f96; text-transform:uppercase; letter-spacing:.06em;">
                        <i class="fa-solid fa-file-lines me-1"></i>ការពិពណ៌នា
                    </p>
                    @if(optional($book->bookDetail)->description)
                        <div style="font-size:14px; color:#4b4f6b; line-height:1.85; white-space:pre-line;">{{ $book->bookDetail->description }}</div>
                    @else
                        <p style="font-size:14px; color:#b0b4c8; font-style:italic; margin:0;">
                            មិនមានការពិពណ៌នាសម្រាប់សៀវភៅនេះឡើយ។
                            <a href="{{ route('book-details.ui.edit', $book->id) }}" style="color:#6c63ff; text-decoration:none; font-style:normal; font-weight:500; margin-left:6px;">
                                + បន្ថែមការពិពណ៌នា
                            </a>
                        </p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

@endsection