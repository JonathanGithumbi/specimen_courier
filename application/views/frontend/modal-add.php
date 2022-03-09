<!-- Modal Add -->
<div id="modalAdd" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="<?= site_url('Manifest/add_specimen') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Specimen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mb-3">
                    <input type="hidden" name="manifest_id" value="<?php echo $this->session->manifest_id ;?>">
                    <!-- Content -->
                    <label for="specimen_id">Specimen Identifier</label>
                    <input type="text" class="form-control" name="specimen_id" id="specimen_id" required>
                    <br>
                    <label for="specimen_id">Name</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                    <br>
                    <label for="specimen_id">Patient Number</label>
                    <input type="text" class="form-control" name="patient_number" id="patient_number" required>
                    <br>
                    <label for="transport_condition">Transport Condition</label>
                    <br>
                    <input type="radio"  name="choice" id="none" value="none" checked>None
                    <br>
                    <input type="radio"  name="choice" id="other" value="other">Other
                    <br>
                    <textarea name="transport condition" id="transport_condition" class="form-control" value="none" cols="30" rows="10"></textarea>
                    <br>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type='submit' class="btn btn-primary" value="Submit">
                </div>
            </form>
        </div>
    </div>
</div>
<script>
$(function(){

$('#transport_condition').hide();

$("#other").click(function(){
$("#transport_condition").show();
});

$("#none").click(function(){
    $("#transport_condition").hide();
});
});
</script>