<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css" />


    <style>
        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #cccbcb;
            color: white;
            text-align: center;
        }
        .ck-editor__editable {
            min-height: 150px;
        }
    </style>
    <link href="https://getbootstrap.com/docs/4.0/examples/sticky-footer/sticky-footer.css" rel="stylesheet">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">POS Mini</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php echo ($this->uri->segment(1)=="product" && $this->uri->segment(2)=="index" ? "active" : "") ;  ?>">
                <a class="nav-link" href="<? echo site_url("product/index")?>">Product</a>
            </li>
            <li class="nav-item <?php echo ($this->uri->segment(1)=="product" && $this->uri->segment(2)=="master" ? "active" : "") ;  ?>">
                <a class="nav-link" href="<? echo site_url("product/master")?>">Master Product</a>
            </li>
            <li class="nav-item <?php echo ($this->uri->segment(1)=="category" && $this->uri->segment(2)=="master" ? "active" : "") ;  ?>">
                <a class="nav-link" href="<? echo site_url("category/master")?>">Master Category</a>
            </li>
        </ul>
    </div>
</nav>


