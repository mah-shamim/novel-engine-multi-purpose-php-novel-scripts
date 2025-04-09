
<!-- Footer -->
<footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl">
        <div
            class="footer-container d-flex align-items-center justify-content-between py-3 flex-md-row flex-column">
            <div class="text-body mb-2 mb-md-0">
                <?php echo APP_NAME; ?>
                ©
                <script>
                    document.write(new Date().getFullYear());
                </script>
                , Develope with <span class="text-danger"><i class="tf-icons mdi mdi-heart"></i></span> by
                <a href="//fb.me/shuraih.usman" target="_blank" class="footer-link fw-medium"
                >Shuraih Usman</a
                >
            </div>
        
        </div>
    </div>
</footer>
<!-- / Footer -->

<div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
</div>
<!-- / Layout page -->
</div>

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
</div>

<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="<?=ADMINASSETS?>/js/jquery-3.6.4.min.js"></script>

<script src="<?=ADMINASSETS?>/vendor/libs/popper/popper.js"></script>
<script src="<?=ADMINASSETS?>/vendor/js/bootstrap.js"></script>
<script src="<?=ADMINASSETS?>/vendor/libs/node-waves/node-waves.js"></script>
<script src="<?=ADMINASSETS?>/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="<?=ADMINASSETS?>/vendor/js/menu.js"></script>
<script src="<?=ADMINASSETS?>/vendor/DataTables/datatables.min.js"></script>
<script src="<?=ADMINASSETS?>/js/select2.min.js"></script>


<script type="importmap">
		{
			"imports": {
				"ckeditor5": "<?=ADMINASSETS?>/vendor/ckeditor/ckeditor5.js",
				"ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/42.0.2/"
			}
		}
		</script>

        <script type="module">
	import { ckeditor } from '<?=ADMINASSETS?>/vendor/ckeditor/main.js';
        </script>

<script>
    

//   tinymce.init({
//     selector: '#desc', 
//     plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
//     toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
//   });
  
//     tinymce.init({
//     selector: '#desc2', 
//     plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
//     toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
//   });
  
//       tinymce.init({
//     selector: '#desc3', 
//     plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
//     toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
//   });



</script>

<script type="module" src="<?=ADMINASSETS?>/js/app.js"></script>



<!-- endbuild -->


<!-- Main JS -->
<script src="<?=ADMINASSETS?>/js/main.js"></script>


<!-- Place this tag in your head or just before your close body tag. -->
<!-- <script src="<?=ADMINASSETS?>/js/buttons.js"></script> -->





<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });


    $(document).on("submit", "#ajaxForm", function (event) {
        event.preventDefault();

        var formData = new FormData(this);

        $("#submit").attr("disabled", "disabled");

        $.ajax({
            url: "",
            type: "POST",
            data: formData,
            contentType: false, // Required for file uploads
            processData: false, // Required for file uploads

            success: function (data) {
                $("#submit").removeAttr("disabled");
                if (data.s == 1) {
                    Swal.fire
                    ("Success!", data.m, "success")
                        .then(() => {
                            location.reload();
                        });
                } else {
                    Swal.fire("Error!", data.m, "warning");
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error: " + error);
                $("#submit").removeAttr("disabled");
                Swal.fire("Error!", "An error occurred during the request." + error, "error");
            },
        });
    });
    document.querySelectorAll('.delete').forEach(function(button) {
        button.addEventListener('click', function() {
            const postId = button.getAttribute('staff-id');
            const table = button.getAttribute('type');
            const field = button.getAttribute('data-field');


                title = 'Are you sure to delete this?';
                but = 'Yes, delete it!';
                txt = 'You won\'t be able to revert this!';




            // Create FormData object with the data
            const formData = new FormData();
            formData.append('table', table);
            formData.append('field', field);
            formData.append('id', postId);

            // Show SweetAlert confirmation
            Swal.fire({
                title: title,
                text: txt,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: but
            }).then((result) => {
                if (result.isConfirmed) {
                    // User confirmed, send an AJAX request to delete the record
                    $.ajax({
                        url: "",
                        type: "POST",
                        data: formData,
                        contentType: false, // Required for file uploads
                        processData: false, // Prevents jQuery from processing data
                        success: function(data) {
                            if (data.s == 1) {
                                Swal.fire({
                                    title: 'Success!',
                                    text: data.m,
                                    icon: 'success'
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: data.m,
                                    icon: 'error'
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: 'Error!',
                                text: 'An error occurred' + error,
                                icon: 'error'
                            });
                        }
                    });
                }
            });
        });
    });





</script>

