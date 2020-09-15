function confirmDelete() {
    var result = confirm("Apakah anda yakin akan menghapus data?");
    
    if (!result) {
        return false;
    }
    
    return true;
}