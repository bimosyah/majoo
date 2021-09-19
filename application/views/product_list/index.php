<?php $this->load->view("include/header"); ?>

    <div id="wrap">
    <div class="container-fluid">
        <div class="row">
            <?php foreach($data as $value): ?>
                <?php
                    $desc = strip_tags($value->deskripsi);
                ?>
                <div class="col-md-3" style="margin-top: 20px; margin-bottom: 20px">
                    <div class="card" style="width: 18rem;height: 40rem">
                        <img class="card-img-top" src="<?php echo site_url("upload/".$value->image) ?>"
                             alt="Card image cap">
                        <div class="card-body d-flex flex-column">
                            <p class="card-text" style="text-align: center"><?php echo $value->nama?></p>
                            <p class="card-text" style="text-align: center"><sup>Rp</sup> <?php echo number_format($value->harga)?></p>
                            <p class="card-text"><?php echo(strlen($desc) > 320 ? substr($desc, 0, 320) . "..." : $desc) ?></p>
                            <button type="button" class="align-self-end btn btn-lg btn-block btn-primary"
                                    style="margin-top: auto;">Beli
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <span class="text-muted">2019 @ PT Majoo Teknologi Indonesia.</span>
        </div>
    </footer>

<?php $this->load->view("include/footer"); ?>