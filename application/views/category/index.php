<?php $this->load->view('include/header')?>
<!-- Begin page content -->
<div class="container-fluid">
    <br>
    <div class="float-right">
        <a type="button" class="btn btn-primary btn-sm" href="<?=site_url('category/master/add')?>">New Category</a>
    </div>
    <br><br>
    <table id="master_category" class="display">
        <thead>
        <tr>
            <th>No.</th>
            <th>Nama Kategori</th>
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
