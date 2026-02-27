import java.util.ArrayList;
import java.util.List;

public class Kursus {
    private String namaKursus;
    private Pengajar tutor;
    private List<Siswa> daftarSiswa;

    public Kursus(String namaKursus, Pengajar tutor) {
        this.namaKursus = namaKursus;
        this.tutor = tutor;
        this.daftarSiswa = new ArrayList<>();
    }

    public void tambahSiswa(Siswa siswa) {
        daftarSiswa.add(siswa);
        System.out.println(siswa.getNama() + " berhasil mendaftar di kelas " + namaKursus);
    }

    public void infoKursus() {
        System.out.println("\n--- Detail Kursus: " + namaKursus + " ---");
        System.out.println("Tutor: " + tutor.getNama());
        System.out.println("Jumlah Peserta: " + daftarSiswa.size());
    }
}
