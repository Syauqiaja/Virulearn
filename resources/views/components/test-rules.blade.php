<div class="test-rules">
  <h5>Aturan Pengerjaan Tes</h5>

  <ul>
    <li><strong>Jenis Tes:</strong> Terdiri dari Pretest (sebelum belajar), Latihan (saat belajar), dan Post Test (setelah belajar).</li>

    <li><strong>Bentuk Soal:</strong> Pilihan ganda A–D, pilih satu jawaban paling benar.</li>

    <li><strong>Ketentuan Umum:</strong> Tidak boleh mencontek, bekerja sama, atau membuka sumber lain. Jawaban tidak bisa diubah setelah dikirim. Sistem menyimpan otomatis jika waktu habis (jika ada timer).</li>

    @if ($this->exam->kkm)
      <li><strong>KKM :</strong> Nilai minimal lulus adalah {{ $this->exam->kkm }}. Jika di bawah, peserta dapat mengulang atau remedial.</li>
    @endif

    @if ($this->exam->duration)
      
      <li><strong>Waktu :</strong> Durasi tes misalnya {{ $this->exam->duration }} menit, dimulai saat soal dibuka.</li>
    @endif


    <li><strong>Penilaian:</strong> Semua soal bernilai sama. Tidak ada pengurangan untuk jawaban salah.</li>

    <li><strong>Hasil:</strong> Ditampilkan langsung setelah submit atau setelah semua peserta menyelesaikan tes (tergantung pengaturan).</li>

    <li><strong>Teknis:</strong> Gunakan perangkat dan koneksi yang stabil. Hubungi pengawas jika terjadi kendala.</li>
  </ul>
</div>
