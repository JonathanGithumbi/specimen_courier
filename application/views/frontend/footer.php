

<!-- Modal Feedback Show -->
<?php if($this->session->flashdata('modal_message')) { ?>
	<?= $this->session->flashdata('modal_message') ?>
	<script>
		$(window).on('load',function(){
			$('#modalFeedback').modal('show');
		});
	</script>
<?php } ?>

</body>
</html>