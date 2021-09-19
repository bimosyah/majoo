<?php $this->load->view('include/header') ?>
<!-- Begin page content -->
<div class="container-fluid">
    <br>
    <div class="card">
        <div class="card-body">
            <form id="">
                <div class="form-group">
                    <label for="nama_produk">Nama Produk</label>
                    <input type="text" class="form-control" name="nama" id="nama_kategori_update" value="<?php echo $nama?>">
                </div>
                <div class="float-right">
                    <a href="<?php echo site_url("category/master")?>" type="button" class="btn btn-danger">Back</a>
                    <button type="button" onclick="submitCategoryUpdate(<?php echo $this->uri->segment(4)?>)" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <span class="text-muted">2019 @ PT Majoo Teknologi Indonesia.</span>
    </div>
</footer>

<?php $this->load->view('include/footer') ?>
