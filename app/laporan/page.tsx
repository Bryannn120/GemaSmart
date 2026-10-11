export default function Laporan() {
  return (
    <div className="flex items-center justify-center min-h-screen bg-surface-subtle text-text-primary">
      <div className="text-center p-8 bg-surface-container-lowest rounded-xl shadow-sm">
        <h1 className="font-headline-lg text-headline-lg mb-2 text-status-warning">Akses Ditolak (Proteksi Layar)</h1>
        <p className="text-body-md font-body-md text-text-secondary">
          Layar "Laporan & Export" ini ternyata diproteksi oleh Google Login di sisi server prototipe (Stitch).
          <br/>
          Harap unggah file HTML-nya secara manual ke chat jika Anda ingin halaman ini dirender.
        </p>
      </div>
    </div>
  );
}