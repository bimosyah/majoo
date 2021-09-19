</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    var myEditor;
    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(editor => {myEditor = editor;})
        .catch(error => {
            console.error(error);
        });

    $(document).ready(function () {
        $('.js-example-basic-single').select2();

        master_product = $('#master_product').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('product/get_list')?>",
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false, //set not orderable
                },
            ],

        });

        master_category = $('#master_category').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('category/get_list')?>",
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false, //set not orderable
                },
            ],

        });


        $('#form_add_product').on('submit',(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var deskripsi = myEditor.getData();

            var kategori = $('#kategori').select2('data')
            formData.append("deskripsi",deskripsi);
            formData.append("kategori",kategori[0].text);
            $.ajax({
                type:'POST',
                url: "<?php echo site_url("product/insert")?>",
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success:function(data){
                    const parse = JSON.parse(JSON.stringify(data))
                    let timerInterval
                    Swal.fire({
                        title: 'Submit form!',
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading()
                            const b = Swal.getHtmlContainer().querySelector('b')
                            timerInterval = setInterval(() => {
                                b.textContent = Swal.getTimerLeft()
                            }, 100)
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                            if (parse.status == "0"){
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: parse.msg,
                                })
                            }else{
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: parse.msg,
                                }).then(function() {
                                    window.location = "<?php echo site_url("product/master")?>";
                                });
                            }
                        }
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            console.log('I was closed by the timer')
                        }
                    })
                },
                error: function(data){
                    console.log("error");
                    console.log(data);
                }
            });
        }));
    });

    function submitCategory(){
        var nama = document.getElementById("nama_kategori").value;
        $.ajax({
            url: "<?php echo site_url("category/insert")?>",
            type: "post",
            data: {nama:nama},
            success: function (response) {
                console.log(response);
                const parse = JSON.parse(JSON.stringify(response))
                let timerInterval
                Swal.fire({
                    title: 'Submit form!',
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                            b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                        if (parse.status == "0"){
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: parse.msg,
                            })
                        }else{
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: parse.msg,
                            }).then(function() {
                                window.location = "<?php echo site_url("category/master")?>";
                            });
                        }
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                    }
                })
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        })
    }

    function submitCategoryUpdate(id){
        var nama = document.getElementById("nama_kategori_update").value;
        $.ajax({
            url: "<?php echo site_url("category/master/saveUpdate/")?>" + id,
            type: "post",
            data: {nama:nama},
            success: function (response) {
                console.log(response);
                const parse = JSON.parse(JSON.stringify(response))
                let timerInterval
                Swal.fire({
                    title: 'Submit form!',
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                            b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                        if (parse.status == "0"){
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: parse.msg,
                            })
                        }else{
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: parse.msg,
                            }).then(function() {
                                window.location = "<?php echo site_url("category/master")?>";
                            });
                        }
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                    }
                })
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        })
    }

</script>
</body>
</html>