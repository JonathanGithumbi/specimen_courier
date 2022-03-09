<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
        <span class="navbar-brand">
                Specimen Pickup Request
                <br>
                <small>Request Form</small>
        </span>

    </nav>

    <div class="container">

        <?php echo validation_errors(); ?>

        <?php echo form_open('SpecimenPickupRequest/process_request'); ?>

        <div class="form-group">
        <label for="dest_facility">Destination Facility:</label>
        <br>
        <select id='dest_facility' name='dest_facility' class='form-control form-control-lg' style='width: 300px;'>
            <option value='0'>-- Select Destination Facility --</option>
        </select>
        </div>


        <div class="form-group">
        <label for="pickup_facility">Pickup Facility:</label>
        <br>
        <select id='pickup_facility' name='pickup_facility' class='form-control form-control-lg' style='width: 300px;'>
            <option value='0'>-- Select Pickup Facility --</option>
        </select>
        </div>
        

        <div class="form-group">
        <label for="pickup_date_time">Pickup Date and Time:</label>
        <br>
        <input class='form-control ' style="width: 300px;" type="datetime-local" name="pickup_date_time" id="pickup_date_time" placeholder='Pick Date and Time'>
        </div>
        
        <br>
        <input class="form control btn btn-primary" type="submit" value="Next">
        </form>

    </div>


    <!-- Script -->
    <script type="text/javascript">
    $(document).ready(function() {

        $("#dest_facility").select2({
            ajax: {
                placeholder: '--Select Destination Facility--',
                url: '<?= base_url() ?>index.php/SpecimenPickupRequest/getDestFacility',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        searchTerm: params.term // search term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
        $("#pickup_facility").select2({
            ajax: {
                placeholder: '--Select Pickup Facility--',
                url: '<?= base_url() ?>index.php/SpecimenPickupRequest/getPickupFacility',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        searchTerm: params.term // search term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
    });
    </script>

</body>

</html>