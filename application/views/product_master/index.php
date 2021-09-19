<?php $this->load->view('include/header')?>
<!-- Begin page content -->
<div class="container-fluid">
    <br>
    <div class="float-right">
        <button type="button" class="btn btn-primary btn-sm">New Product</button>
    </div>
    <br><br>
    <table id="master_product" class="display">
        <thead>
        <tr>
            <th>No.</th>
            <th>Nama Produk</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Kategori</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        </thead>
    </table>
</div>

<footer class="footer">
    <div class="container">
        <span class="text-muted">2019 @ PT Majoo Teknologi Indonesia.</span>
    </div>
</footer>

<?php $this->load->view('include/footer')?>
