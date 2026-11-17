<!-- Global Dynamic Footer Component -->
<footer class="footer" style="background: #0b1329; color: #94a3b8; padding: 60px 0 30px; border-top: 1px solid rgba(255,255,255,0.06); font-family: inherit;">
    <div style="max-width: 100%; margin: 0 auto; padding: 0 32px; box-sizing: border-box;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 40px; margin-bottom: 50px;">
            
            <!-- Kolom 1: Profil Organisasi -->
            <div>
                <a href="{{ url('/') }}" style="font-family: 'Outfit', sans-serif; font-size: 1.5rem; font-weight: 800; color: #ffffff; text-decoration: none; display: inline-block; margin-bottom: 16px;">
                    {{ $settings['org_name'] ?? 'PAC IPNU IPPNU Kemiri' }}
                </a>
                <p style="font-size: 0.9rem; line-height: 1.7; color: #94a3b8; margin: 0; max-width: 380px;">
                    {{ $settings['footer_desc'] ?? 'Ikatan Pelajar Nahdlatul Ulama & Ikatan Pelajar Putri Nahdlatul Ulama Kecamatan Kemiri. Berkhidmat tanpa batas, berinovasi tiada henti.' }}
                </p>
            </div>

            <!-- Kolom 2: Tautan Cepat -->
            <div>
                <h4 style="font-family: 'Outfit', sans-serif; font-size: 1.05rem; font-weight: 700; color: #ffffff; margin: 0 0 18px 0; text-transform: uppercase; letter-spacing: 0.5px;">
                    Tautan Cepat
                </h4>
                <ul class="footer-links" style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 10px;">
                    @if(isset($footerLinks) && $footerLinks->count() > 0)
                        @foreach($footerLinks as $fl)
                            <li>
                                <a href="{{ Str::startsWith($fl->url, ['http://', 'https://']) ? $fl->url : url($fl->url) }}" target="{{ $fl->target }}" style="color: #94a3b8; text-decoration: none; font-size: 0.9rem; transition: all 0.2s; display: inline-block;" onmouseover="this.style.color='var(--accent, #facc15)'; this.style.paddingLeft='4px';" onmouseout="this.style.color='#94a3b8'; this.style.paddingLeft='0';">
                                    {{ $fl->title }}
                                </a>
                            </li>
                        @endforeach
                    @else
                        <li><a href="{{ url('/') }}#beranda" style="color:#94a3b8; text-decoration:none;">Beranda</a></li>
                        <li><a href="{{ url('/profil/sejarah') }}" style="color:#94a3b8; text-decoration:none;">Profil &amp; Sejarah</a></li>
                        <li><a href="{{ url('/') }}#agenda" style="color:#94a3b8; text-decoration:none;">Agenda Kegiatan</a></li>
                        <li><a href="{{ url('/') }}#berita" style="color:#94a3b8; text-decoration:none;">Berita Terbaru</a></li>
                        <li><a href="{{ url('/artikel') }}" style="color:#94a3b8; text-decoration:none;">Artikel Pelajar</a></li>
                        <li><a href="{{ url('/dokumen') }}" style="color:#94a3b8; text-decoration:none;">Pusat Dokumen Resmi</a></li>
                        <li><a href="{{ url('/galeri') }}" style="color:#94a3b8; text-decoration:none;">Galeri Foto</a></li>
                        <li><a href="{{ url('/library') }}" style="color:#94a3b8; text-decoration:none;">Digital Library</a></li>
                        <li><a href="{{ url('/voting') }}" style="color:#94a3b8; text-decoration:none;">Polling Pemilu</a></li>
                    @endif
                </ul>
            </div>

            <!-- Kolom 3: Hubungi Kami -->
            <div>
                <h4 style="font-family: 'Outfit', sans-serif; font-size: 1.05rem; font-weight: 700; color: #ffffff; margin: 0 0 18px 0; text-transform: uppercase; letter-spacing: 0.5px;">
                    Hubungi Kami
                </h4>
                <ul class="footer-links" style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px; font-size: 0.9rem;">
                    <li style="color: #ffffff; font-weight: 700; display: flex; align-items: flex-start; gap: 10px;">
                        <i class="fa-solid fa-building" style="color: var(--accent, #facc15); margin-top: 3px; font-size: 1rem; width: 16px;"></i>
                        <span>{{ !empty($settings['sekre_title']) ? $settings['sekre_title'] : (!empty($settings['org_name']) ? 'Sekretariat ' . $settings['org_name'] : 'Sekretariat PAC IPNU IPPNU Kemiri') }}</span>
                    </li>
                    <li style="display: flex; align-items: flex-start; gap: 10px;">
                        <i class="fa-solid fa-location-dot" style="color: var(--accent, #facc15); margin-top: 3px; font-size: 1rem; width: 16px;"></i>
                        <a href="{{ url('/profil/lokasi') }}" style="color: #94a3b8; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='var(--accent, #facc15)';" onmouseout="this.style.color='#94a3b8';">
                            {{ $settings['address'] ?? 'Kecamatan Kemiri, Purworejo, Jawa Tengah' }}
                        </a>
                    </li>
                    <li style="display: flex; align-items: center; gap: 10px;">
                        <i class="fa-solid fa-envelope" style="color: var(--accent, #facc15); font-size: 1rem; width: 16px;"></i>
                        <a href="mailto:{{ $settings['email'] ?? 'info@ipnukemiri.or.id' }}" style="color: #94a3b8; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='var(--accent, #facc15)';" onmouseout="this.style.color='#94a3b8';">
                            {{ $settings['email'] ?? 'info@ipnukemiri.or.id' }}
                        </a>
                    </li>
                    <li style="display: flex; align-items: center; gap: 10px;">
                        <i class="fa-brands fa-whatsapp" style="color: #22c55e; font-size: 1.1rem; width: 16px;"></i>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp'] ?? '6281234567890') }}" target="_blank" style="color: #94a3b8; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#22c55e';" onmouseout="this.style.color='#94a3b8';">
                            {{ $settings['whatsapp'] ?? '+62 812 3456 7890' }}
                        </a>
                    </li>
                    <li style="margin-top: 6px; display: flex; align-items: center; gap: 10px;">
                        <i class="fa-solid fa-paper-plane" style="color: var(--accent, #facc15); font-size: 0.95rem; width: 16px;"></i>
                        <a href="{{ url($settings['footer_lapor_url'] ?? '/kontak') }}" style="color: var(--accent, #facc15); font-weight: 700; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.paddingLeft='4px';" onmouseout="this.style.paddingLeft='0';">
                            {{ $settings['footer_lapor_text'] ?? 'Ruang Lapor & Saran' }} &rarr;
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Baris Bawah: Hak Cipta -->
        <div style="border-top: 1px solid rgba(255,255,255,0.08); padding-top: 24px; text-align: center; font-size: 0.85rem; color: #64748b;">
            <p style="margin: 0;">
                &copy; {{ date('Y') }} {{ $settings['org_name'] ?? 'PAC IPNU IPPNU Kemiri' }}. {{ $settings['footer_copyright'] ?? 'Dikembangkan dengan ❤️ untuk kemajuan Pelajar NU.' }}
            </p>
        </div>
    </div>
</footer>

