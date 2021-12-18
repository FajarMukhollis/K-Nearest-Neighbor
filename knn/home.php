<div class="hentry">
  <div class="page-header">
    <h1 class="entry-title"> KNN (k-Nearest Neighbor)</h1>
  </div>
  <div class="hidden">
    <div class="entry-summary">k-Nearest Neighbor (KNN) </div>
  </div>
  <div class="entry-content">
    <p>K-Nearest Neighbor (K-NN) adalah suatu metode yang menggunakan algoritma superviseddimana hasil dariquery instanceyang baru diklasifikan berdasarkan mayoritas dari kategori pada K-NN. Tujuan dari algoritma ini adalah mengklasifikasikan obyek baru bedasarkan atribut dantraining sample. Classifier tidak menggunakan model apapun untuk dicocokkan dan hanya berdasarkan pada memori. Diberikan titikquery akan ditemukan sejumlahkobyek atau (titik training) yang paling dekat dengan titikquery. Klasifikasi menggunakan voting terbanyak diantara klasifikasi dari k obyek. Algoritma K-NN menggunakan klasifikasi ketetanggaan sebagai nilai prediksi dari query instance yang baru.</p>
    <p>Algoritma metode K-NN sangatlah sederhana, bekerja berdasarkan jarak terpendek dariquery instance ke training sample untuk menentukan K-NN-nya. Training sample diproyeksikan ke ruang berdimensi banyak, dimana masing-masing dimensi merepresentasikan fitur dari data.Ruang ini dibagi menjadi bagian-bagian berdasarkan klasifikasitraining sample.Sebuah titik pada ruang ini ditandai kelas c jika kelas c merupakan klasifikasi yang paling banyak ditemui pada k buah tetangga terdekat dari titik tersebut. Dekat atau jauhnya tetangga biasanya dihitung berdasarkan Euclidean Distance yang direpresentasikan pada persamaan 1 sebagai berikut: </p>
    <img src="assets/ed.png">
    <p>dimana matriks D(a,b) adalah jarak skalar dari kedua vector a dan b dari matriks dengan ukuran dimensi.</p>
  </div>
</div>