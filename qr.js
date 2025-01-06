function tampilkanWaktuNyata() {
  const sekarang = new Date(); // Ambil waktu saat ini
  const optionsTanggal = {
    weekday: "long",
    year: "numeric",
    month: "long",
    day: "numeric",
    timeZone: "Asia/Jakarta",
  };

  // Format tanggal: Hari, Tanggal Bulan Tahun
  const tanggal = sekarang.toLocaleDateString("id-ID", optionsTanggal);

  // Format waktu: Jam:Menit:Detik
  const waktu = sekarang
    .toLocaleTimeString("id-ID", {
      hour: "2-digit",
      minute: "2-digit",
      second: "2-digit",
      timeZone: "Asia/Jakarta",
    })
    .replace(/\./g, ":"); // Ganti semua titik menjadi titik dua

  // Menampilkan hasil ke elemen HTML
  document.getElementById("tanggal").innerText = tanggal;
  document.getElementById("waktu").innerText = waktu + " WIB";
}

// Perbarui setiap 1 detik
setInterval(tampilkanWaktuNyata, 1000);

// Panggil pertama kali agar langsung tampil
tampilkanWaktuNyata();

// waktu mundur
// Set durasi waktu mundur dalam detik (15 menit = 900 detik)
let waktuMundur = 5 * 60;

// Fungsi untuk menampilkan waktu mundur
function tampilkanCountdown() {
  const menit = Math.floor(waktuMundur / 60);
  const detik = waktuMundur % 60;

  // Format angka agar selalu dua digit (contoh: 08, 09)
  const formatMenit = String(menit).padStart(2, "0");
  const formatDetik = String(detik).padStart(2, "0");

  // Tampilkan di elemen HTML
  document.getElementById(
    "countdown"
  ).innerText = `${formatMenit}:${formatDetik}`;

  // Kurangi waktu mundur
  waktuMundur--;

  // Hentikan interval ketika waktu habis
  if (waktuMundur < 0) {
    clearInterval(interval);
    document.getElementById("countdown").innerText = "Waktu Habis!";
  }
}

// Panggil fungsi setiap 1 detik
const interval = setInterval(tampilkanCountdown, 1000);

// Tampilkan waktu pertama kali saat halaman dimuat
tampilkanCountdown();
