<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
        <span class="navbar-brand">Specimen Pickup
            <br>
            <small>Validate Specimen Pickup</small>
        </span>


    </nav>
    <!-- Content Page -->
    <div class="container">

        <!-- Header -->
        <div class="content-header">

            <!-- Title -->
            <span class="content-title">Specimen List</span>

        </div>

        <!-- Table Transaction -->
        <div class="table-responsive">
            <table class="table table-striped border">
                <thead class="text-center">
                    <th class="table-order border">#</th>
                    <th class="table-content border">Content</th>
                    <th class="table-status border">Status</th>
                </thead>

                <tbody>
                    <?php foreach($specimen_list as $key => $qr) { ?>
                    <tr class="text-center">

                        <!-- Number -->
                        <td class="border"><?= $key+1 ?></td>

                        <!-- Content -->
                        <td class="border"><?= $qr['specimen_id'] ?></td>

                        <!-- Status -->
                        <?php if($qr['status']=='pending_delivery'):?>
                        <td class="border"><span class="badge badge-pill badge-secondary">Pending Transport</span></td>

                        <?php elseif($qr['status']=='in_transit'):?>
                        <td class="border"><span class="badge badge-pill badge-warning">In Transit</span></td>

                        <?php elseif($qr['status']=='received'):?>
                        <td class="border"><span class="badge badge-pill badge-success">Received</span></td>

                        <?php elseif($qr['status']=='rejected'):?>
                        <td class="border"><span class="badge badge-pill badge-danger">Rejected</span></td>

                        <?php else:?>
                        <td class="border"></td>

                        <?php endif; ?>

                    </tr>
                    <?php } ?>

                    <!-- Empty State -->
                    <?php if(empty($specimen_list)) { ?>
                    <tr class="text-center">
                        <td colspan="4">Manifest Not Yet Build</td>
                    </tr>
                    <?php } ?>

                </tbody>

            </table>
        </div>




        <!-- Show -->
        <br>
        <br> 
        <center>
            <button data-toggle="modal" data-target="#modalShow" class="btn  btn-success mr-2">
                <span class="fas fa-eye"></span> Scan QR Code
            </button>

        </center>

    </div>

    <!-- Load Modal Views -->
    <?php 
    $this->load->view('frontend/modal-scan');
   
?>