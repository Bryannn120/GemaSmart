"use client";

import { useState } from "react";
import Head from "next/head";

export default function Login() {
  const [passwordVisible, setPasswordVisible] = useState(false);
  const [isToastVisible, setIsToastVisible] = useState(false);
  const [isSubmitting, setIsSubmitting] = useState(false);
  const [btnText, setBtnText] = useState("Masuk ke Sistem");

  const togglePasswordVisibility = () => {
    setPasswordVisible(!passwordVisible);
  };

  const showPasswordHelp = (e: React.MouseEvent) => {
    e.preventDefault();
    setIsToastVisible(!isToastVisible);
  };

  const handleLogin = (e: React.FormEvent) => {
    e.preventDefault();
    
    // Simulate login
    setIsSubmitting(true);
    setBtnText("Memverifikasi Kredensial...");

    setTimeout(() => {
      setBtnText("Mengalihkan ke Dashboard...");
      setTimeout(() => {
        setIsSubmitting(false);
        setBtnText("Masuk ke Sistem");
        alert("Selamat datang di Gema Smart Sumbawa. Otentikasi sesi berhasil.");
        window.location.href = "/dashboard";
      }, 700);
    }, 900);
  };

  return (
    <div className="bg-surface font-body-md text-body-md text-on-surface antialiased selection:bg-primary-fixed selection:text-on-primary-fixed">
      <main className="min-h-screen w-full bg-surface">
        <div className="flex flex-col w-full">
          <div className="w-full min-h-[calc(100vh-0px)] flex flex-col lg:flex-row bg-canvas-bg">
            {/* LEFT PANEL: LOGIN FORM (45-50% Desktop, Full width mobile) */}
            <div className="w-full lg:w-[48%] xl:w-[45%] flex flex-col justify-between px-6 sm:px-12 md:px-16 lg:px-14 xl:px-20 py-8 lg:py-12 bg-canvas-bg z-10">
              {/* Top Section: Header & Identitas Pemda */}
              <div>
                {/* Emblem & Brand Bar */}
                <div className="flex items-center gap-3.5 mb-8">
                  <div className="w-12 h-12 rounded-lg bg-surface-subtle p-1 flex items-center justify-center shadow-sm overflow-hidden flex-shrink-0">
                    <img
                      alt="Gema Smart Sumbawa Emblem"
                      className="w-full h-full object-contain"
                      src="/gemas.jpg"
                    />
                  </div>
                  <div className="flex flex-col">
                    <div className="flex items-center gap-1.5">
                      <span className="font-label-sm text-label-sm uppercase tracking-wider text-text-secondary">
                        Pemerintah Kab. Sumbawa
                      </span>
                      <span className="w-1.5 h-1.5 rounded-full bg-status-verified"></span>
                    </div>
                    <span className="font-label-lg text-label-lg text-primary font-bold">
                      Dinas Pertanian & Ketahanan Pangan
                    </span>
                  </div>
                </div>

                {/* Portal Heading */}
                <div className="mb-8">
                  <div className="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-gov-green-surface text-primary text-label-sm font-label-sm mb-3">
                    <span className="material-symbols-outlined text-[14px]">shield</span>
                    <span>Portal Masuk Layanan Terpadu</span>
                  </div>
                  <h1 className="font-headline-xl text-headline-xl text-text-primary tracking-tight mb-2">
                    Gema Smart Sumbawa
                  </h1>
                  <p className="font-headline-sm text-headline-sm text-primary font-semibold mb-2">
                    Sistem Monitoring Penyaluran & Pendampingan Bantuan Bibit
                  </p>
                  <p className="font-body-md text-body-md text-text-secondary">
                    Silakan masukkan email kedinasan/institusi dan kata sandi Anda untuk masuk ke sistem monitoring.
                  </p>
                </div>

                {/* Notification Banner / Alert */}
                <div className="mb-6 p-3.5 bg-surface-subtle rounded-md flex items-start gap-3">
                  <span className="material-symbols-outlined text-primary text-[20px] mt-0.5 flex-shrink-0">
                    info
                  </span>
                  <p className="font-body-sm text-body-sm text-text-secondary leading-relaxed">
                    Akses khusus Aparatur Sipil Negara, Penyuluh Pertanian Lapangan (PPL), serta Petugas Verifikasi terdaftar di wilayah Sumbawa.
                  </p>
                </div>

                {/* Form Elements */}
                <form className="space-y-4" onSubmit={handleLogin}>
                  {/* Email Field */}
                  <div className="space-y-1.5">
                    <label className="block font-label-lg text-label-lg text-text-primary" htmlFor="email">
                      Alamat Email
                    </label>
                    <div className="relative flex items-center">
                      <span className="absolute left-3 text-text-tertiary material-symbols-outlined text-[20px] pointer-events-none">
                        mail
                      </span>
                      <input
                        className="w-full h-11 pl-10 pr-3.5 bg-canvas-bg rounded text-body-md font-body-md text-text-primary placeholder:text-text-tertiary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all shadow-sm"
                        id="email"
                        name="email"
                        placeholder="nama@sumbawakab.go.id atau email terdaftar"
                        required
                        type="email"
                      />
                    </div>
                  </div>

                  {/* Password Field */}
                  <div className="space-y-1.5">
                    <div className="flex items-center justify-between">
                      <label className="block font-label-lg text-label-lg text-text-primary" htmlFor="password">
                        Kata Sandi
                      </label>
                      <span className="font-label-sm text-label-sm text-text-tertiary">Enkripsi 256-bit</span>
                    </div>
                    <div className="relative flex items-center">
                      <span className="absolute left-3 text-text-tertiary material-symbols-outlined text-[20px] pointer-events-none">
                        lock
                      </span>
                      <input
                        className="w-full h-11 pl-10 pr-11 bg-canvas-bg rounded text-body-md font-body-md text-text-primary placeholder:text-text-tertiary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all shadow-sm"
                        id="password"
                        name="password"
                        placeholder="Masukkan kata sandi"
                        required
                        type={passwordVisible ? "text" : "password"}
                      />
                      <button
                        aria-label="Tampilkan atau sembunyikan kata sandi"
                        className="absolute right-3 p-1 text-text-secondary hover:text-text-primary transition-colors focus:outline-none"
                        onClick={togglePasswordVisibility}
                        type="button"
                      >
                        <span className="material-symbols-outlined text-[20px]">
                          {passwordVisible ? "visibility_off" : "visibility"}
                        </span>
                      </button>
                    </div>
                  </div>

                  {/* Remember Me Checkbox */}
                  <div className="flex items-center justify-between pt-1">
                    <label className="flex items-center gap-2.5 cursor-pointer select-none">
                      <input
                        className="w-4 h-4 rounded text-primary focus:ring-primary focus:ring-offset-0 transition"
                        id="rememberMe"
                        name="rememberMe"
                        type="checkbox"
                      />
                      <span className="font-body-md text-body-md text-text-secondary">
                        Ingat sesi masuk saya
                      </span>
                    </label>
                    <span className="inline-flex items-center gap-1 font-label-sm text-label-sm text-status-verified">
                      <span className="material-symbols-outlined text-[15px]">verified_user</span>
                      <span>Koneksi Aman</span>
                    </span>
                  </div>

                  {/* Primary Submit Button */}
                  <div className="pt-2">
                    <button
                      className={`w-full h-11 bg-primary hover:bg-[#144A18] active:bg-[#0c5216] text-on-primary font-label-lg text-label-lg rounded-md transition duration-150 flex items-center justify-center gap-2 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 ${
                        isSubmitting ? "opacity-80 cursor-wait" : ""
                      }`}
                      disabled={isSubmitting}
                      type="submit"
                    >
                      <span>{btnText}</span>
                      <span className="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </button>
                  </div>

                  {/* Forgot Password Link */}
                  <div className="text-center pt-2 pb-2">
                    <a
                      className="font-body-md text-body-md text-primary font-semibold hover:text-gov-green-dark hover:underline focus:outline-none inline-flex items-center gap-1"
                      href="#lupa-password"
                      onClick={showPasswordHelp}
                    >
                      <span className="material-symbols-outlined text-[16px]">help</span>
                      <span>Lupa Password atau Mengalami Kendala Akses?</span>
                    </a>
                  </div>
                </form>

                {/* Notification Toast */}
                {isToastVisible && (
                  <div className="mt-4 p-3 bg-gold-surface text-secondary rounded-md shadow-sm flex items-center gap-2.5">
                    <span className="material-symbols-outlined text-[20px] text-gold-accent">contact_support</span>
                    <p className="font-body-sm text-body-sm">
                      Hubungi Admin Pusdatin Distan Sumbawa di <strong>pusdatin@sumbawakab.go.id</strong> atau Ext. 104 untuk reset token.
                    </p>
                  </div>
                )}
              </div>

              {/* Left Panel Footer */}
              <div className="pt-8 mt-6">
                <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-text-secondary">
                  <p className="font-body-sm text-body-sm">Ãƒâ€šÃ‚Â© 2026 Dinas Pertanian Kabupaten Sumbawa</p>
                  <div className="flex items-center gap-1.5 font-label-sm text-label-sm text-text-tertiary">
                    <span className="material-symbols-outlined text-[14px]">lock</span>
                    <span>Dilindungi Enkripsi AES-256 & UU PDP No. 27/2022</span>
                  </div>
                </div>
              </div>
            </div>

            {/* RIGHT PANEL: IMMERSIVE AGRICULTURAL VISUAL & BENEFIT CARDS (52-55% Desktop) */}
            <div className="hidden lg:flex lg:w-[52%] xl:w-[55%] relative overflow-hidden flex-col justify-between p-12 xl:p-16 text-on-primary">
              {/* Background Photo with Deep Forest Green Overlay */}
              <div
                className="absolute inset-0 bg-cover bg-center transition-transform duration-1000 scale-105"
                style={{
                  backgroundImage:
                    "url('/bg.jpg')",
                }}
              ></div>
              {/* Rich Forest Green Ambient Gradient Overlay (#1B5E20 at ~80% depth) */}
              <div className="absolute inset-0 bg-gradient-to-tr from-[#092B0D]/95 via-[#1B5E20]/85 to-[#0E3A13]/80"></div>
              {/* Subtle Decorative SVG Watermark Graphic (Agrarian Contour Pattern) */}
              <svg
                className="absolute -right-20 -bottom-20 w-96 h-96 text-white/5 pointer-events-none"
                fill="currentColor"
                viewBox="0 0 200 200"
              >
                <path
                  d="M42,-72C54.9,-66.1,65.6,-54.6,73.1,-41.2C80.6,-27.8,85,-12.5,83.9,2.4C82.8,17.2,76.2,31.7,67.2,43.8C58.3,55.9,46.9,65.7,33.9,71.2C20.8,76.7,6.1,77.9,-8.7,76.1C-23.5,74.3,-38.3,69.5,-50.2,60.8C-62,52,-70.8,39.3,-76.3,25.1C-81.8,10.9,-83.9,-4.8,-79.8,-18.8C-75.7,-32.8,-65.4,-45.1,-52.8,-51.2C-40.2,-57.3,-25.3,-57.2,-11.2,-61.2C2.8,-65.1,16.8,-73.1,30.3,-75.4C43.8,-77.7,56.8,-74.3,42,-72Z"
                  transform="translate(100 100)"
                ></path>
              </svg>
              {/* Right Top: Government Authority Badge */}
              <div className="relative z-10 flex items-center justify-between">
                <div className="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-white/10 backdrop-blur-md shadow-lg">
                  <div className="w-2.5 h-2.5 rounded-full bg-secondary-container animate-pulse"></div>
                  <span className="font-label-sm text-label-sm tracking-wide uppercase text-secondary-fixed">
                    Sistem Satu Data Penyaluran Bibit Sumbawa
                  </span>
                </div>
                <div className="flex items-center gap-2 text-white/80 font-code-dense text-code-dense">
                  <span className="material-symbols-outlined text-[16px]">cloud_done</span>
                  <span>Server Aktif: Sumbawa-Node-01</span>
                </div>
              </div>
              {/* Right Center: Narrative Tagline & Highlights Grid */}
              <div className="relative z-10 my-auto py-10 max-w-xl">
                <div className="inline-block mb-3 px-3 py-1 rounded bg-secondary-container text-on-secondary-container font-label-sm text-label-sm">
                  Amanat Perbup Sumbawa No. 18/2024
                </div>
                <h2 className="font-headline-xl text-headline-xl text-white font-bold leading-tight mb-4 tracking-tight">
                  Mewujudkan Distribusi Bantuan Bibit Pertanian yang Transparan, Akuntabel, dan Presisi.
                </h2>
                <p className="font-body-lg text-body-lg text-white/90 leading-relaxed mb-8">
                  Platform terpusat pengawasan rantai pasok bibit tanaman pangan, hortikultura, dan perkebunan untuk menjamin ketepatan sasaran kelompok tani (Poktan).
                </p>
                {/* 3 Feature Glass Cards */}
                <div className="space-y-3.5">
                  {/* Card 1 */}
                  <div className="flex items-start gap-4 p-4 rounded-lg bg-white/10 backdrop-blur-md hover:bg-white/15 transition-all shadow-md">
                    <div className="w-10 h-10 rounded-md bg-white/20 flex items-center justify-center flex-shrink-0 text-white">
                      <span className="material-symbols-outlined text-[22px]">fingerprint</span>
                    </div>
                    <div>
                      <h3 className="font-headline-sm text-headline-sm text-white mb-0.5">
                        Anti-Duplikasi NIK & KK Terintegrasi
                      </h3>
                      <p className="font-body-sm text-body-sm text-white/80">
                        Penyelarasan otomatis dengan database Dukcapil dan Simluhtan untuk mencegah penerima bantuan ganda lintas kecamatan.
                      </p>
                    </div>
                  </div>
                  {/* Card 2 */}
                  <div className="flex items-start gap-4 p-4 rounded-lg bg-white/10 backdrop-blur-md hover:bg-white/15 transition-all shadow-md">
                    <div className="w-10 h-10 rounded-md bg-white/20 flex items-center justify-center flex-shrink-0 text-white">
                      <span className="material-symbols-outlined text-[22px]">pin_drop</span>
                    </div>
                    <div>
                      <h3 className="font-headline-sm text-headline-sm text-white mb-0.5">
                        Bukti Penyaluran Geotagging & Tanda Tangan Digital
                      </h3>
                      <p className="font-body-sm text-body-sm text-white/80">
                        Validasi titik koordinat lahan penerima secara riil saat serah terima bibit fisik disertai e-signature ketua kelompok tani.
                      </p>
                    </div>
                  </div>
                  {/* Card 3 */}
                  <div className="flex items-start gap-4 p-4 rounded-lg bg-white/10 backdrop-blur-md hover:bg-white/15 transition-all shadow-md">
                    <div className="w-10 h-10 rounded-md bg-white/20 flex items-center justify-center flex-shrink-0 text-white">
                      <span className="material-symbols-outlined text-[22px]">fact_check</span>
                    </div>
                    <div>
                      <h3 className="font-headline-sm text-headline-sm text-white mb-0.5">
                        Audit Sampling Uji Petik Independen
                      </h3>
                      <p className="font-body-sm text-body-sm text-white/80">
                        Fitur acak statistik untuk inspeksi berkala kesehatan bibit dan daya tumbuh pasca-tanam oleh Inspektorat Daerah.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              {/* Right Bottom: Authority Stamp & Regional Context */}
              <div className="relative z-10 pt-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 text-white/80">
                <div>
                  <p className="font-label-md text-label-md text-white">Pemerintah Kabupaten Sumbawa</p>
                  <p className="font-body-sm text-body-sm text-white/70">
                    Dinas Pertanian & Ketahanan Pangan ÃƒÂ¢Ã¢â€šÂ¬Ã‚Â¢ Nusa Tenggara Barat
                  </p>
                </div>
                <div className="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 backdrop-blur-sm text-white text-label-sm font-label-sm">
                  <span className="material-symbols-outlined text-[16px] text-secondary-container">eco</span>
                  <span>Gema Smart v3.4.2 Enterprise</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  );
}
