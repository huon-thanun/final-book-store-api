@extends('layouts.dashboard')

@section('content')

{{-- Stat bar --}}
<div class="row g-3 mb-5">
    <div class="col-md-4">
        <div class="stat-card d-flex align-items-center gap-3" style="background: #fff; padding: 20px; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
            <div class="stat-icon" style="background: rgba(108,99,255,0.1); width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                <i class="fa-solid fa-book" style="color:#6c63ff; font-size: 20px;"></i>
            </div>
            <div>
                <div class="stat-label" style="font-size: 13px; color: #7b7f96;">សៀវភៅសរុប</div>
                <div class="stat-value" style="font-size: 22px; font-weight: 700; color: #1a1d2e;">
                    {{ $booksCount }}<span style="font-size:14px; color:#7b7f96; margin-left:4px;">ក្បាល</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card d-flex align-items-center gap-3" style="background: #fff; padding: 20px; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
            <div class="stat-icon" style="background: rgba(14, 165, 233, 0.1); width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                <i class="fa-solid fa-tags" style="color:#0ea5e9; font-size: 20px;"></i>
            </div>
            <div>
                <div class="stat-label" style="font-size: 13px; color: #7b7f96;">ប្រភេទសៀវភៅសរុប</div>
                <div class="stat-value" style="font-size: 22px; font-weight: 700; color: #1a1d2e;">
                    {{ $categoriesCount }}<span style="font-size:14px; color:#7b7f96; margin-left:4px;">ប្រភេទ</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card d-flex align-items-center gap-3" style="background: #fff; padding: 20px; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
            <div class="stat-icon" style="background: rgba(16, 185, 129, 0.1); width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                <i class="fa-solid fa-pen-nib" style="color:#10b981; font-size: 20px;"></i>
            </div>
            <div>
                <div class="stat-label" style="font-size: 13px; color: #7b7f96;">អ្នកនិពន្ធសរុប</div>
                <div class="stat-value" style="font-size: 22px; font-weight: 700; color: #1a1d2e;">
                    {{ $authorsCount }}<span style="font-size:14px; color:#7b7f96; margin-left:4px;">រូប</span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Table card --}}
<div class="card border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center" style="padding: 20px;">
        <div class="d-flex align-items-center gap-2">
            <div style="width:6px; height:22px; background:#6c63ff; border-radius:3px;"></div>
            <h5 class="mb-0 fw-bold" style="font-size:16px; color:#1a1d2e;">ប្រព័ន្ធគ្រប់គ្រងទិន្នន័យ (រដ្ឋបាល)</h5>
        </div>
        
        {{-- Create Button (Admin Only) --}}
        @if(Auth::user()?->role === 'admin')
            <a href="{{ route('books.ui.create') }}" class="btn btn-primary btn-sm d-flex align-items-center gap-2" style="background:#6c63ff; border:none; padding: 8px 16px; border-radius: 8px;">
                <i class="fa-solid fa-plus" style="font-size:12px;"></i>
                <span>បន្ថែមថ្មី</span>
            </a>
        @endif
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr style="background:#fafbfc; border-bottom: 1px solid #e8eaf0;">
                        <th style="padding: 14px 20px; font-size:11px; color:#7b7f96; font-weight:600; text-transform:uppercase; letter-spacing:.05em;">គម្រប</th>
                        <th style="padding: 14px 16px; font-size:11px; color:#7b7f96; font-weight:600; text-transform:uppercase; letter-spacing:.05em;">ចំណងជើង</th>
                        <th style="padding: 14px 16px; font-size:11px; color:#7b7f96; font-weight:600; text-transform:uppercase; letter-spacing:.05em;">ប្រភេទ</th>
                        <th style="padding: 14px 16px; font-size:11px; color:#7b7f96; font-weight:600; text-transform:uppercase; letter-spacing:.05em;">អ្នកនិពន្ធ</th>
                        <th style="padding: 14px 16px; font-size:11px; color:#7b7f96; font-weight:600; text-transform:uppercase; letter-spacing:.05em;">តម្លៃ</th>
                        <th style="padding: 14px 20px; font-size:11px; color:#7b7f96; font-weight:600; text-transform:uppercase; letter-spacing:.05em; text-align:right;">សកម្មភាព</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $book)
                    <tr style="border-bottom: 1px solid #f0f1f5; cursor:pointer;" onclick="window.location='{{ route('books.ui.show', $book->id) }}'" class="book-row">
                        <td style="padding: 14px 20px;">
                            @if($book->cover_image)
                                <img src="{{ asset('storage/' . $book->cover_image) }}" style="width:42px; height:56px; object-fit:cover; border-radius:6px; border:1px solid #e8eaf0;">
                            @else
                                <div style="width:42px; height:56px; background:#f5f6fa; border:1px solid #e8eaf0; border-radius:6px; display:flex; align-items:center; justify-content:center;">
                                    <i class="fa-solid fa-book" style="color:#c5c7d4; font-size:14px;"></i>
                                </div>
                            @endif
                        </td>
                        <td style="padding: 14px 16px;">
                            <span style="font-weight:600; font-size:14px; color:#1a1d2e;">{{ $book->title }}</span>
                        </td>
                        <td style="padding: 14px 16px;">
                            <span style="background:rgba(108,99,255,0.08); color:#5a52d5; font-size:12px; font-weight:500; padding:4px 10px; border-radius:20px; border:1px solid rgba(108,99,255,0.15);">
                                {{ $book->category->name ?? 'N/A' }}
                            </span>
                        </td>
                        <td style="padding: 14px 16px; color:#7b7f96; font-size:14px;">
                            <i class="fa-regular fa-user me-1" style="font-size:12px;"></i>{{ $book->author }}
                        </td>
                        <td style="padding: 14px 16px;">
                            <span style="font-weight:700; font-size:15px; color:#22c55e;">${{ number_format($book->price, 2) }}</span>
                        </td>
                        <td style="padding: 14px 20px; text-align:right;" onclick="event.stopPropagation()">
                            <div class="d-flex justify-content-end gap-1">
                                {{-- View Detail --}}
                                <a href="{{ route('books.ui.show', $book->id) }}" title="មើលព័ត៌មាន" style="height:32px; padding:0 12px; border-radius:8px; border:1px solid #d1d5db; background:#fff; color:#374151; display:inline-flex; align-items:center; gap:5px; font-size:12px; font-weight:600; text-decoration:none; font-family:'Kantumruy Pro',sans-serif;">
                                    <i class="fa-solid fa-eye" style="font-size:12px;"></i>
                                    <span>មើល</span>
                                </a>

                                {{-- Action controls for Admin only --}}
                                @if(Auth::user()?->role === 'admin')
                                    {{-- Edit Detail Info --}}
                                    <a href="{{ route('book-details.ui.edit', $book->id) }}" title="ព័ត៌មានលម្អិត" style="width:32px; height:32px; border-radius:8px; border:1px solid #bfdbfe; background:#eff6ff; color:#2563eb; display:inline-flex; align-items:center; justify-content:center; font-size:13px; text-decoration:none;">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a>

                                    {{-- Edit --}}
                                    <a href="{{ route('books.ui.edit', $book->id) }}" title="កែប្រែ" style="width:32px; height:32px; border-radius:8px; border:1px solid #fde68a; background:#fffbeb; color:#d97706; display:inline-flex; align-items:center; justify-content:center; font-size:13px; text-decoration:none;">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    {{-- Delete Modal Action --}}
                                    <button type="button" title="លុប" onclick="openDeleteModal({{ $book->id }}, '{{ addslashes($book->title) }}')" style="width:32px; height:32px; border-radius:8px; border:1px solid #fecaca; background:#fef2f2; color:#dc2626; display:inline-flex; align-items:center; justify-content:center; font-size:13px; cursor:pointer;">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>

                                    {{-- Hidden Form submission --}}
                                    <form id="delete-form-{{ $book->id }}" action="{{ route('books.ui.destroy', $book->id) }}" method="POST" style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align:center; padding:60px 20px;">
                            <div>
                                <i class="fa-solid fa-box-open fa-3x" style="color:#e2e4ee; display:block; margin-bottom:12px;"></i>
                                <p style="color:#7b7f96; font-size:14px; margin:0;">មិនទាន់មានទិន្នន័យសៀវភៅនៅក្នុងប្រព័ន្ធឡើយ។</p>
                                @if(Auth::user()?->role === 'admin')
                                    <a href="{{ route('books.ui.create') }}" class="btn btn-primary btn-sm mt-3">
                                        <i class="fa-solid fa-plus me-1"></i>បន្ថែមសៀវភៅដំបូង
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Delete Confirmation Modal --}}
<div id="delete-modal-backdrop" onclick="closeDeleteModal()" style="display:none; position:fixed; inset:0; background:rgba(15,17,23,0.55); z-index:1040; backdrop-filter:blur(2px); transition:opacity .2s;"></div>

<div id="delete-modal" role="dialog" aria-modal="true" aria-labelledby="modal-title" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -56%); width:420px; background:#fff; border-radius:16px; z-index:1050; box-shadow:0 24px 64px rgba(0,0,0,0.18); padding:32px; transition:transform .2s, opacity .2s;">
    {{-- Icon --}}
    <div style="width:56px; height:56px; border-radius:50%; background:#fef2f2; border:6px solid #fff; outline:1px solid #fecaca; display:flex; align-items:center; justify-content:center; margin:0 auto 20px;">
        <i class="fa-solid fa-trash" style="color:#dc2626; font-size:20px;"></i>
    </div>

    {{-- Text Contents --}}
    <h5 id="modal-title" style="text-align:center; font-size:17px; font-weight:700; color:#1a1d2e; margin:0 0 8px;">លុបសៀវភៅ?</h5>
    <p style="text-align:center; font-size:14px; color:#7b7f96; margin:0 0 6px;">អ្នកកំពុងលុប</p>
    <p id="modal-book-name" style="text-align:center; font-size:15px; font-weight:700; color:#1a1d2e; margin:0 0 24px; padding:10px 16px; background:#fafbfc; border:1px solid #e8eaf0; border-radius:8px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;"></p>
    <p style="text-align:center; font-size:13px; color:#b0b4c8; margin:0 0 28px;">សកម្មភាពនេះមិនអាចត្រឡប់វិញបានទេ។</p>

    {{-- Actions Buttons --}}
    <div style="display:flex; gap:10px;">
        <button onclick="closeDeleteModal()" style="flex:1; height:42px; border-radius:9px; border:1px solid #e8eaf0; background:#fff; color:#374151; font-size:14px; font-weight:600; cursor:pointer; font-family:'Kantumruy Pro',sans-serif; transition:background .15s;">
            បោះបង់
        </button>
        <button id="modal-confirm-btn" onclick="submitDelete()" style="flex:1; height:42px; border-radius:9px; border:none; background:#dc2626; color:#fff; font-size:14px; font-weight:600; cursor:pointer; font-family:'Kantumruy Pro',sans-serif; transition:background .15s;">
            <i class="fa-solid fa-trash me-1"></i> បញ្ជាក់លុប
        </button>
    </div>
</div>

<style>
    .book-row:hover { background: #fafbff !important; }
    #delete-modal.show { transform: translate(-50%, -50%); opacity: 1; }
    #delete-modal-backdrop.show { opacity: 1; }
    #modal-confirm-btn:hover { background: #b91c1c !important; }

    @keyframes modalIn {
        from { opacity:0; transform:translate(-50%, -44%); }
        to   { opacity:1; transform:translate(-50%, -50%); }
    }
    #delete-modal.show { animation: modalIn .18s ease forwards; }
</style>

<script>
    let _deleteTargetId = null; 

    function openDeleteModal(id, title) {
        _deleteTargetId = id;
        document.getElementById('modal-book-name').textContent = '"' + title + '"';

        const backdrop = document.getElementById('delete-modal-backdrop');
        const modal    = document.getElementById('delete-modal');

        backdrop.style.display = 'block';
        modal.style.display    = 'block';

        requestAnimationFrame(() => {
            backdrop.classList.add('show');
            modal.classList.add('show');
        });
    }

    function closeDeleteModal() {
        const backdrop = document.getElementById('delete-modal-backdrop');
        const modal    = document.getElementById('delete-modal');

        backdrop.classList.remove('show');
        modal.classList.remove('show');

        setTimeout(() => {
            backdrop.style.display = 'none';
            modal.style.display    = 'none';
            _deleteTargetId = null;
        }, 180);
    }

    function submitDelete() {
        if (_deleteTargetId) {
            document.getElementById('delete-form-' + _deleteTargetId).submit();
        }
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeDeleteModal();
    });
</script>

@endsection