<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
        <span class="navbar-brand">Specimen Pickup Request
        <br>
        <small>Build Specimen</small>
        </span>
       
        
    </nav>
    <!-- Content Page -->
    <div class="container">

        <!-- Header -->
        <div class="content-header">

            <!-- Title -->
            <span class="content-title">Specimen List</span>

            <!-- Add Button -->
            <a data-toggle="modal" data-target="#modalAdd" class="btn btn-sm btn-primary float-right">
                <i class="fas fa-plus"></i> Add Specimen
            </a>

        </div>

        <!-- Table Transaction -->
        <div class="table-responsive">
            <table class="table table-striped border">
                <thead class="text-center">
                    <th class="table-order border">#</th>
                    <th class="table-content border">Content</th>
                    <th class="table-status border">Status</th>
                    <th class="table-action border">Action</th>
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

                        <!-- Action -->
                        <td class="border">

                            <!-- Show -->
                            <button data-toggle="modal" data-target="#modalShow<?= $qr['specimen_id'] ?>"
                                class="btn btn-sm btn-success mr-2">
                                <span class="fas fa-eye"></span> QR Code
                            </button>

                            <!-- Edit -->
                            <button data-toggle="modal" data-target="#modalEdit<?= $qr['specimen_id'] ?>"
                                class="btn btn-sm btn-primary mr-2 px-2">
                                <span class="fas fa-edit"></span> Edit
                            </button>

                            <!-- Delete -->
                            <button data-toggle="modal" data-target="#modalDelete<?= $qr['specimen_id'] ?>"
                                class="btn btn-sm btn-danger">
                                <span class="fas fa-trash"></span> Delete
                            </button>
                        </td>

                    </tr>
                    <?php } ?>

                    <!-- Empty State -->
                    <?php if(empty($specimen_list)) { ?>
                    <tr class="text-center">
                        <td colspan="4">Add Specimens</td>
                    </tr>
                    <?php } ?>

                </tbody>

            </table>
        </div>


        
        <a class="btn btn-primary" href='<?php echo base_url();?>Manifest/summary/<?= $request_id?>'>
           Done 
        </a>

    </div>

    <!-- Load Modal Views -->
    <?php 
    $this->load->view('frontend/modal-add');
    $this->load->view('frontend/modal-detail');
    $this->load->view('frontend/modal-edit');
    $this->load->view('frontend/modal-delete');
?>