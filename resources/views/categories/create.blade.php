@extends('layouts.dashboard')

@section('content')
<div style="max-width:520px;">

    {{-- Page heading --}}
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('books.ui') }}"
           style="width:36px; height:36px; border-radius:9px; border:1px solid #e8eaf0; background:#fff;
                  display:flex; align-items:center; justify-content:center; text-decoration:none;
                  color:#7b7f96; font-size:14px; transition:border-color .15s, color .15s;"
           onmouseover="this.style.borderColor='#6c63ff';this.style.color='#6c63ff';"
           onmouseout="this.style.borderColor='#e8eaf0';this.style.color='#7b7f96';">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <p style="margin:0; font-size:11px; color:#7b7f96; font-weight:600;
                      text-transform:uppercase; letter-spacing:.08em;">Categories</p>
            <h1 style="margin:0; font-size:20px; font-weight:700; color:#1a1d2e; line-height:1.3;">
                បង្កើតប្រភេទថ្មី
            </h1>
        </div>
    </div>

    {{-- Main card --}}
    <div class="card" style="border-radius:16px !important; border:1px solid #e8eaf0 !important;
                             box-shadow:0 4px 20px rgba(108,99,255,0.06) !important; overflow:hidden;">

        {{-- Card accent top bar --}}
        <div style="height:3px; background:linear-gradient(90deg, #6c63ff 0%, #a78bfa 100%);"></div>

        <div class="card-body" style="padding:32px;">
            <form action="{{ route('categories.ui.store') }}" method="POST">
                @csrf

                {{-- Icon row --}}
                <div class="d-flex align-items-center gap-3 mb-5">
                    <div style="width:56px; height:56px; border-radius:14px;
                                background:rgba(108,99,255,0.08); border:1.5px dashed rgba(108,99,255,0.3);
                                display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                        <i class="fa-solid fa-tags" style="color:#6c63ff; font-size:22px;"></i>
                    </div>
                    <div>
                        <p style="margin:0; font-weight:700; font-size:14px; color:#1a1d2e;">ប្រភេទសៀវភៅ</p>
                        <p style="margin:0; font-size:13px; color:#7b7f96; line-height:1.5;">
                            ប្រភេទនឹងបង្ហាញនៅក្នុងទំព័របញ្ជី
                        </p>
                    </div>
                </div>

                {{-- Name field --}}
                <div style="margin-bottom:28px;">
                    <label class="form-label" style="font-size:13px; font-weight:600; color:#4b4f6b; margin-bottom:8px;">
                        ឈ្មោះប្រភេទ
                    </label>

                    <div style="position:relative;">
                        <i class="fa-solid fa-tag"
                           style="position:absolute; left:13px; top:50%; transform:translateY(-50%);
                                  color:#a8adc0; font-size:13px; pointer-events:none;"></i>
                        <input type="text" name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               style="padding-left:38px; border-radius:10px; border:1.5px solid #e8eaf0;
                                      font-size:14px; height:44px; transition:border-color .15s, box-shadow .15s;"
                               value="{{ old('name') }}"
                               placeholder="ឧទាហរណ៍: ប្រលោមលោក, ការអប់រំ, វិទ្យាសាស្ត្រ"
                               required
                               autocomplete="off">
                    </div>

                    @error('name')
                        <div class="invalid-feedback d-flex align-items-center gap-1" style="font-size:12px; margin-top:6px;">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            {{ $message }}
                        </div>
                    @enderror

                    <p style="font-size:12px; color:#a8adc0; margin-top:8px; margin-bottom:0; display:flex; align-items:center; gap:5px;">
                        <i class="fa-regular fa-circle-question" style="font-size:11px;"></i>
                        ជ្រើសឈ្មោះខ្លី ច្បាស់លាស់ ងាយស្គាល់
                    </p>
                </div>

                {{-- Preview badge --}}
                <div id="preview-wrap"
                     style="margin-bottom:28px; padding:14px 16px; background:#fafbfc;
                            border:1px solid #f0f1f5; border-radius:10px; display:flex;
                            align-items:center; gap:10px;">
                    <span style="font-size:12px; color:#a8adc0; font-weight:500; flex-shrink:0;">
                        មើលជាមុន:
                    </span>
                    <span id="preview-badge"
                          style="display:inline-flex; align-items:center; gap:5px;
                                 background:rgba(108,99,255,0.08); color:#5a52d5;
                                 font-size:12px; font-weight:600; padding:5px 12px;
                                 border-radius:20px; border:1px solid rgba(108,99,255,0.18);
                                 transition:opacity .2s; opacity:.4;">
                        <i class="fa-solid fa-tag" style="font-size:10px;"></i>
                        <span id="preview-text">ឈ្មោះប្រភេទ</span>
                    </span>
                </div>

                {{-- Actions --}}
                <div class="d-flex gap-2 justify-content-end"
                     style="border-top:1px solid #f0f1f5; padding-top:20px;">
                    <a href="{{ route('books.ui') }}" class="btn btn-light"
                       style="height:40px; display:inline-flex; align-items:center; gap:6px; font-size:13px;">
                        <i class="fa-solid fa-xmark"></i>
                        <span>បោះបង់</span>
                    </a>
                    <button type="submit" class="btn btn-primary"
                            style="height:40px; display:inline-flex; align-items:center; gap:6px;
                                   font-size:13px; padding:0 20px;">
                        <i class="fa-solid fa-plus"></i>
                        <span>បង្កើតប្រភេទ</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Tip box --}}
    <div style="margin-top:16px; padding:14px 16px;
                background:rgba(108,99,255,0.04); border:1px solid rgba(108,99,255,0.13);
                border-radius:12px; display:flex; gap:10px; align-items:flex-start;">
        <div style="width:28px; height:28px; border-radius:8px; background:rgba(108,99,255,0.1);
                    display:flex; align-items:center; justify-content:center; flex-shrink:0; margin-top:1px;">
            <i class="fa-solid fa-lightbulb" style="color:#6c63ff; font-size:12px;"></i>
        </div>
        <p style="margin:0; font-size:13px; color:#5a52d5; line-height:1.65;">
            ប្រភេទដែលបង្កើតហើយ នឹងអាចជ្រើសរើសបានភ្លាមៗ នៅពេលបន្ថែម ឬកែប្រែសៀវភៅ
        </p>
    </div>
</div>

{{-- Live preview script --}}
<script>
(function () {
    const input   = document.querySelector('input[name="name"]');
    const badge   = document.getElementById('preview-badge');
    const preview = document.getElementById('preview-text');

    if (!input || !preview) return;

    input.addEventListener('input', function () {
        const val = this.value.trim();
        if (val) {
            preview.textContent = val;
            badge.style.opacity = '1';
        } else {
            preview.textContent = 'ឈ្មោះប្រភេទ';
            badge.style.opacity = '.4';
        }
    });
})();
</script>
@endsection