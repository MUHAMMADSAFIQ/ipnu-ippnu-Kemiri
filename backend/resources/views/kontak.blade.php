@extends('layouts.portal')

@section('content')
<div class="na-wrapper">
    <div class="na-header"><span>📩 KRITIK & SARAN</span></div>
    <div style="padding: 40px; background: white;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">
            <div>
                <h2 style="font-family: 'Outfit'; font-weight: 800; color: var(--primary); margin-bottom: 20px;">Sampaikan Aspirasi Anda</h2>
                <p style="color: #475569; line-height: 1.8; margin-bottom: 30px;">
                    Kami sangat menghargai setiap masukan, kritik, maupun saran yang membangun demi kemajuan PAC IPNU IPPNU Kemiri yang lebih baik di masa depan.
                </p>
                
                <div style="display: flex; flex-direction: column; gap: 20px;">
                    <div style="display: flex; gap: 15px; align-items: center;">
                        <div style="width: 40px; height: 40px; background: #f1f5f9; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: var(--primary);">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div>
                            <div style="font-size: 0.75rem; font-weight: 800; color: #64748b;">EMAIL RESMI</div>
                            <div style="font-weight: 700;">admin@ipnukemiri.or.id</div>
                        </div>
                    </div>
                    <div style="display: flex; gap: 15px; align-items: center;">
                        <div style="width: 40px; height: 40px; background: #f1f5f9; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: var(--primary);">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div>
                            <div style="font-size: 0.75rem; font-weight: 800; color: #64748b;">WHATSAPP CENTER</div>
                            <div style="font-weight: 700;">+62 812 3456 7890</div>
                        </div>
                    </div>
                </div>
            </div>

            <div style="background: #f8fafc; padding: 30px; border-radius: 20px; border: 1px solid #e2e8f0;">
                <form action="#" method="POST" style="display: flex; flex-direction: column; gap: 15px;">
                    <div>
                        <label style="display: block; font-size: 0.8rem; font-weight: 800; margin-bottom: 5px;">NAMA LENGKAP</label>
                        <input type="text" placeholder="Masukkan nama Anda..." style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8rem; font-weight: 800; margin-bottom: 5px;">E-MAIL / NO. HP</label>
                        <input type="text" placeholder="Untuk kami hubungi kembali..." style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8rem; font-weight: 800; margin-bottom: 5px;">PESAN / MASUKAN</label>
                        <textarea rows="5" placeholder="Tuliskan kritik atau saran Anda di sini..." style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px;"></textarea>
                    </div>
                    <button type="button" onclick="alert('Terima kasih! Pesan Anda telah terkirim.')" style="background: var(--primary); color: white; border: none; padding: 15px; border-radius: 10px; font-weight: 800; cursor: pointer; transition: background 0.2s;">
                        KIRIM PESAN SEKARANG
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
