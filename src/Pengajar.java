public class Pengajar extends User{
    private String keahlian;

    public Pengajar(String id, String nama, String keahlian) {
        super(id, nama);
        this.keahlian = keahlian;
    }

    @Override
    public void tampilkanProfil() {
        super.tampilkanProfil();
        System.out.println("Status: Pengajar | Bidang: " + keahlian);
    }
}
