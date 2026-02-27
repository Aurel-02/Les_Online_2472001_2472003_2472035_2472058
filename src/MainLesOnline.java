public class MainLesOnline {
    public static void main(String[] args) {
        // Inisialisasi Data
        Pengajar tutorJava = new Pengajar("T01", "Budi Santoso", "Pemrograman Java");
        Siswa siswa1 = new Siswa("S01", "Andi", "SMA");
        Siswa siswa2 = new Siswa("S02", "Siti", "Kuliah");

        // Proses Bisnis Sederhana
        Kursus kelasJava = new Kursus("Backend Development", tutorJava);

        kelasJava.tambahSiswa(siswa1);
        kelasJava.tambahSiswa(siswa2);

        // Menampilkan Output
        tutorJava.tampilkanProfil();
        kelasJava.infoKursus();
    }
}
