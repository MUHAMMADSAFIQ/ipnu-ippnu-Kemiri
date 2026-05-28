@extends('layouts.portal')

@section('content')
<div class="na-wrapper">
    <div class="na-header"><span>📊 STATISTIK ORGANISASI</span></div>
    <div style="padding: 40px; background: white;">
        
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 25px; margin-bottom: 50px;">
            <div style="text-align: center; padding: 30px; background: #f0fdf4; border-radius: 20px; border: 1px solid #dcfce7;">
                <div style="font-size: 3rem; font-weight: 900; color: var(--primary);">450+</div>
                <div style="font-weight: 800; color: #166534; text-transform: uppercase; font-size: 0.8rem;">Kader Aktif</div>
            </div>
            <div style="text-align: center; padding: 30px; background: #fffbeb; border-radius: 20px; border: 1px solid #fef3c7;">
                <div style="font-size: 3rem; font-weight: 900; color: #d97706;">12</div>
                <div style="font-weight: 800; color: #92400e; text-transform: uppercase; font-size: 0.8rem;">Pimpinan Ranting</div>
            </div>
            <div style="text-align: center; padding: 30px; background: #f0f9ff; border-radius: 20px; border: 1px solid #e0f2fe;">
                <div style="font-size: 3rem; font-weight: 900; color: #0284c7;">5</div>
                <div style="font-weight: 800; color: #075985; text-transform: uppercase; font-size: 0.8rem;">Komisariat</div>
            </div>
        </div>

        <div class="na-wrapper" style="border-radius: 12px;">
            <div class="na-header" style="background: #475569;">KOMPOSISI KADER PER WILAYAH</div>
            <div style="padding: 20px;">
                @foreach(['Kemiri', 'Sukoanyar', 'Kedunglo', 'Wonotopo', 'Kerep'] as $desa)
                <div style="margin-bottom: 15px;">
                    <div style="display: flex; justify-content: space-between; font-size: 0.85rem; font-weight: 700; margin-bottom: 5px;">
                        <span>PR {{ $desa }}</span>
                        <span>{{ rand(30, 80) }} Anggota</span>
                    </div>
                    <div style="height: 10px; background: #f1f5f9; border-radius: 10px; overflow: hidden;">
                        <div style="height: 100%; background: var(--primary); width: {{ rand(40, 90) }}%;"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection
