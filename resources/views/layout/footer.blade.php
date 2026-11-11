<footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl">
        <div class="footer-container d-flex align-items-center justify-content-between py-3 flex-md-row flex-column">
            <div class="text-body mb-2 mb-md-0">
                ©
                <script>
                    document.write(new Date().getFullYear());
                </script>
                , made with <span class="text-danger"><i class="tf-icons mdi mdi-heart"></i></span> by
                <a href="https://www.hilfedienst.com/" target="_blank" class="footer-link fw-medium">Hilfedienst</a>
            </div>
        </div>
    </div>
</footer>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Bestätigung</h1>
            </div>
            <div class="modal-body">
                <p>Bitte beachten Sie, dass unsere Leistungen ausschließlich auf Grundlage unserer Allgemeinen Geschäftsbedingungen (AGB) erbracht werden.</p>
            </div>
            <div class="modal-footer">
                <a href="{{ url('agree') }}" type="button" id="confirmBtn" class="btn btn-primary">Bestätigen</a>
            </div>
        </div>
    </div>
</div>



   <script>



        document.addEventListener("DOMContentLoaded", function () {

            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {
                backdrop: 'static',  // Disable outside click
                keyboard: false      // Disable ESC key
            });

            let checkPopup = "{{ $popup }}";

            if(checkPopup == 1){
                myModal.show();
            }


            // document.getElementById("confirmBtn").addEventListener("click", function () {
            //     myModal.hide();
            // });

        });

</script>

