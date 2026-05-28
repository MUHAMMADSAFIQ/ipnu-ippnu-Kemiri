@extends('layouts.portal')

@section('content')
<div style="background:var(--bg-light);min-height:80vh;padding:40px 0;">

    {{-- Header --}}
    <div style="background:linear-gradient(135deg,var(--primary-dark),var(--primary));padding:48px 24px;text-align:center;margin-bottom:48px;position:relative;overflow:hidden;">
        <div style="position:absolute;inset:0;background:url('{{ asset('images/hero_bg.png') }}') center/cover;opacity:0.08;"></div>
        <div style="position:relative;z-index:1;">
            <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(250,204,21,0.15);border:1px solid rgba(250,204,21,0.3);padding:6px 18px;border-radius:50px;color:#facc15;font-size:0.78rem;font-weight:800;text-transform:uppercase;letter-spacing:1px;margin-bottom:16px;">
                🛒 Layanan Pelajar
            </div>
            <h1 style="font-family:'Outfit',sans-serif;font-weight:900;font-size:2.2rem;color:white;margin-bottom:10px;text-shadow:0 2px 10px rgba(0,0,0,0.3);">
                LAPAK USAHA PELAJAR
            </h1>
            <p style="color:rgba(255,255,255,0.75);font-size:0.9rem;max-width:500px;margin:0 auto;">
                Dukung kemandirian ekonomi organisasi. Beli atribut resmi dan produk dari kader IPNU IPPNU Kemiri.
            </p>
        </div>
    </div>

    <div style="max-width:1100px;margin:0 auto;padding:0 16px;">

        @if($products->isEmpty())
        <div style="text-align:center;padding:80px 24px;background:white;border-radius:24px;border:1px solid #e2e8f0;box-shadow:0 4px 20px rgba(0,0,0,0.05);">
            <div style="font-size:4rem;margin-bottom:16px;opacity:0.3;">🛒</div>
            <h3 style="font-family:'Outfit';font-weight:900;font-size:1.4rem;color:#64748b;margin-bottom:8px;">Belum Ada Produk</h3>
            <p style="font-size:0.9rem;color:#94a3b8;">Produk lapak akan ditampilkan setelah admin menambahkan data.</p>
        </div>
        @else
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(270px,1fr));gap:24px;">
            @foreach($products as $product)
            <div style="background:white;border-radius:20px;overflow:hidden;border:1px solid #e2e8f0;box-shadow:0 4px 16px rgba(0,0,0,0.06);transition:transform 0.3s,box-shadow 0.3s;"
                 onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 12px 40px rgba(0,0,0,0.1)'"
                 onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 16px rgba(0,0,0,0.06)'">

                {{-- Product Image --}}
                <div style="height:200px;background:#f8fafc;overflow:hidden;display:flex;align-items:center;justify-content:center;">
                    @if($product->image)
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                             style="width:100%;height:100%;object-fit:cover;transition:transform 0.4s;"
                             onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'">
                    @else
                        <div style="font-size:5rem;color:#cbd5e1;"><i class="fa-solid fa-store"></i></div>
                    @endif
                </div>

                {{-- Product Info --}}
                <div style="padding:20px;">
                    <h4 style="font-family:'Outfit';font-weight:800;font-size:1.05rem;color:#0f172a;margin-bottom:8px;line-height:1.3;">{{ $product->name }}</h4>
                    <div style="font-family:'Outfit';font-size:1.4rem;font-weight:900;color:var(--primary);margin-bottom:16px;">
                        Rp {{ number_format($product->price,0,',','.') }}
                    </div>

                    @if($product->wa_link)
                        <a href="{{ $product->wa_link }}" target="_blank"
                           style="display:flex;align-items:center;justify-content:center;gap:8px;background:#25d366;color:white;padding:12px;border-radius:12px;text-decoration:none;font-weight:800;font-size:0.85rem;transition:all 0.2s;"
                           onmouseover="this.style.background='#128c7e'" onmouseout="this.style.background='#25d366'">
                            <i class="fa-brands fa-whatsapp"></i> Pesan via WhatsApp
                        </a>
                    @else
                        <button style="width:100%;background:#f1f5f9;color:#64748b;border:none;padding:12px;border-radius:12px;font-weight:700;cursor:default;font-size:0.85rem;">
                            Hubungi Admin untuk Pemesanan
                        </button>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif

        {{-- CTA --}}
        <div style="text-align:center;margin-top:48px;padding:28px;background:linear-gradient(135deg,#f0fdf4,#dcfce7);border-radius:20px;border:1px solid #bbf7d0;">
            <p style="color:var(--primary-dark);font-weight:700;font-size:0.88rem;margin-bottom:12px;">
                Ingin mendaftarkan usaha atau lapak Anda?
            </p>
            <a href="{{ route('admin.login') }}" style="display:inline-flex;align-items:center;gap:8px;background:var(--primary);color:white;padding:10px 22px;border-radius:10px;font-weight:700;font-size:0.85rem;text-decoration:none;"
               onmouseover="this.style.background='var(--primary-dark)'" onmouseout="this.style.background='var(--primary)'">
                <i class="fa-solid fa-lock"></i> Daftarkan Produk (Admin)
            </a>
        </div>
    </div>
</div>
@endsection
