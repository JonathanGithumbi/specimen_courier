<!-- Modal Show -->
<?php foreach($specimen_list as $key => $qr) { ?>
<div id="modalShow<?= $qr['specimen_id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Specimen QR Code</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mb-3">

                <!-- QR Image -->
                <img src="<?= site_url($qr['file']) ?>" class="content-img" alt="<?= $qr['specimen_id'] ?>">

                <!-- Content -->
                <span class="form-control text-center"><?= $qr['specimen_id'] ?></span>
                <br>
                <span ><a class='form-control btn btn-primary' href="<?php echo base_url();?>Manifest/print_qr/<?php echo $qr['specimen_id'];?>/" style="text-decoration:none">Print</a></span>

            </div>
        </div>
    </div>
</div>
<?php } ?>