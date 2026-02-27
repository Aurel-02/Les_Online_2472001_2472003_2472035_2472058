public class Siswa extends User{
    private String tingkatan;

    public Siswa(String id, String nama, String tingkatan) {
        super(id, nama);
        this.tingkatan = tingkatan;
    }

    @Override
    public void tampilkanProfil() {
        super.tampilkanProfil();
        System.out.println("Status: Siswa | Tingkat: " + tingkatan);
    }
}
