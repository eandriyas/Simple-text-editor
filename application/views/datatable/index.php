<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Index datatable</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
	 <link href="<?php echo base_url('assets/datatable/css/jquery.dataTables.min.css');?>" rel="stylesheet" />
</head>
<body>

	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<h1>Welcome to Datatable!</h1>
				<hr>
				<table id="example" class="display table" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>First name</th>
							<th>Last name</th>
							<th>Position</th>
							<th>Office</th>
							<th>Start date</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>First name</th>
							<th>Last name</th>
							<th>Position</th>
							<th>Office</th>
							<th>Start date</th>
						</tr>
					</tfoot>
				</table>

			</div>
		</div>

	</div>

	<script src="<?php echo base_url('assets/bootstrap/js/jquery-2.1.4.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/datatable/js/jquery.dataTables.min.js') ?>"></script>
	<script>
		$(document).ready(function() {
    // Setup - add a text input to each footer cell
    // No. 1
    $('#example tfoot th').each( function () {
    	var title = $(this).text();
    	var inp   = '<input type="text" class="form-control" placeholder="Search '+ title +'" />';
    	$(this).html(inp);
    } );

    // DataTable
    // No. 2
    var table = $('#example').DataTable({
    	"processing": true,
    	"serverSide": true,
    	"ajax": {
    		"url": "<?php echo base_url('datatable/datatables_ajax');?>",
    		"type": "POST"
    	}
    });

    // Apply the search
    // No. 3
    table.columns().every( function () {
    	var that = this;

    	$( 'input', this.footer() ).on( 'keyup change', function () {
    		if ( that.search() !== this.value ) {
    			that
    			.search( this.value )
    			.draw();
    		}
    	} );
    } );
} );
	</script>
</body>
</html>