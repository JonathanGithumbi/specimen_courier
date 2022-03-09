<div class="jumbotron">
    <br>
    <h4>Requests</h4>
</div>
<div class="container">

    <div class="list-group">
        <?php foreach($my_requests as $key => $qr) { ?>
        <a href="<?php echo base_url();?>Manifest/summary/<?php echo $qr['request_id']?>"
            class="list-group-item list-group-item-action list-group-item-primary">
            Request ID - <?php echo $qr['request_id']?><br>
            Pick Up Date and Time - <?= $qr['pickup_date_time']?><br>

        </a>
        <br>
        <?php }?>
    </div>
    <?php if(empty($my_requests)) { ?>
    <tr class="text-center">
        <td colspan="4">No Pickup Requests Made</td>
    </tr>
    <?php } ?>
    <br>
    <a class="btn btn-primary" href='<?php echo base_url();?>Landing/'>
        Home
    </a>
</div>