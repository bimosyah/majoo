<?php $this->load->view('include/header') ?>
<!-- Begin page content -->
<div class="container-fluid">
    <br>
    <div class="card">
        <div class="card-body">
            <form id="form_add_product">
                <div class="form-group">
                    <label for="nama_produk">Nama Produk</label>
                    <input type="text" class="form-control" name="nama" id="nama">
                </div>

                <div class="form-group">
                    <label for="editor">Deskripsi</label>
                    <div id="editor" style="height: 50px"></div>
                </div>

                <div class="form-group">
                    <label for="">Kategori</label>
                    <select class="col-md-12 js-example-basic-single" name="kategori" id="kategori">
                        <?php foreach ($category as $value): ?>
                            <option value="<?php echo $value->id ?>"><?php echo $value->nama ?></option>
                        <? endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Upload Image Produk</label>
                    <input type="file" class="form-control-file" name="image" id="image">
                </div>
                <div class="form-group">
                    <label for="nama_produk">Harga</label>
                    <input type="number" class="form-control" name="harga" id="harga">
                </div
                <div class="float-right">
                    <a href="<?php echo site_url("product/master")?>" type="button" class="btn btn-danger">Back</a>
                    <button type="submit" class="btn btn-success">Save</button>
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
