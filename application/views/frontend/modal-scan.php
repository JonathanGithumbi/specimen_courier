<!-- Modal Show -->

<div id="modalShow" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Scan Specimen QR Code</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mb-3">

                <div id="reader" width="600px"></div>

                <script>
                function onScanSuccess(qrMessage) {
                    // handle the scanned code as you like, for example:    
                        
                    $.post(
                        '<?= base_url()?>Reception/validate_specimen_pickup/'+qrMessage,
                        {qr_code: qrMessage},
                        function(data,status)
                        {
                            window.location.assign("<?php echo base_url()?>Reception/")                        
                        }

                    
                    );
                   
                }

                function onScanFailure(error) {
                    // handle scan failure, usually better to ignore and keep scanning.
                    
                }

                let html5QrcodeScanner = new Html5QrcodeScanner(
                    "reader", {
                        fps: 10,
                        qrbox: 250
                    },  verbose= false);
                html5QrcodeScanner.render(onScanSuccess, onScanFailure);
                </script>
            </div>
        </div>
    </div>
</div>
