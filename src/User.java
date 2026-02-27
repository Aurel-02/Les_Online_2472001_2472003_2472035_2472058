public class User {
    private String id;
    private String nama;

    public User(String id, String nama) {
        this.id = id;
        this.nama = nama;
    }

    public String getNama() { return nama; }
    public void tampilkanProfil() {
        System.out.println("[" + id + "] Nama: " + nama);
    }
}
