<?php $this->load->view('include/header')?>
<!-- Begin page content -->
<div class="container-fluid">
    <br>
    <div class="float-right">
        <a type="button" class="btn btn-primary btn-sm" href="<?=site_url('product/master/add')?>">New Product</a>
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
