<!-- Modal Edit -->
<?php foreach($specimen_list as $key => $qr) { ?>
<div id="modalEdit<?= $qr['specimen_id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="<?= site_url('Manifest/edit_data/'.$qr['specimen_id']) ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mb-3">

                    <!-- Content -->
                    <label for="specimen_id">Specimen Identifier</label>
                    <input type="text" class="form-control" value="<?php echo $qr['specimen_id'];?>" name="specimen_id"
                        id="specimen_id" required>
                    <br>
                    <label for="specimen_id">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?php echo $qr['name'];?>"
                        required>
                    <br>
                    <label for="specimen_id">Patient Number</label>
                    <input type="text" class="form-control" name="patient_number"
                        value="<?php echo $qr['patient_number'];?>" id="patient_number" required>
                    <br>
                    <label for="transport_condition">Transport Condition</label>
                    <br>
                    <?php if(empty($qr['transport_condition'])):?>
                        <input type="text" class="form-control" cols="30" rows="10" name="transport_condition" id="transport_condition" placeholder="(Leave Empty for None...)">
                    <br>
                    <?php endif;?>
                    <?php if(!empty($qr['transport_condition'])):?>
                    <input type="text" class="form-control" cols="30" rows="10" name="transport_condition" id="transport_condition" value="<?php echo $qr['transport_condition'];?>">
                    <br>
                    <?php endif;?>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type='submit' class="btn btn-primary" value="Submit">
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>