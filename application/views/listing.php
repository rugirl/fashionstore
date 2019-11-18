<html>
<head>
	<title>Fashion Store</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.3.1/jquery.bootgrid.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.3.1/jquery.bootgrid.js"></script>
</head>
<body>
<div class="container box">
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
		<!-- Brand -->
		<a class="navbar-brand" href="<?php echo base_url(); ?>">Fashion Store</a>

		<!-- Links -->
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link text-muted">Hi <?=$this->session->userdata('username')?>!</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url(); ?>admin">Listing</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url(); ?>admin/logout">Logout</a>
			</li>
		</ul>
	</nav>
	<br>

	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row">
				<div class="col-md-10">
					<h3 class="panel-title">Fashion Store Listing</h3>
				</div>
				<div class="col-md-2" align="right">
					<button type="button" id="add_button" data-toggle="modal" data-target="#clothesModal" class="btn btn-info btn-xs">Add</button>
				</div>
			</div>

		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table id="clothes_data" class="table table-striped table-bordered">
					<thead>
					<tr>
						<th data-column-id="product_id">Product ID</th>
						<th data-column-id="name">Name</th>
						<th data-column-id="product_code">product code</th>
						<th data-column-id="short_description">short description</th>
						<th data-column-id="cost">cost</th>
						<th data-column-id="selling_price">Selling Price (LKR)</th>
						<th data-column-id="brand_name">Brand</th>
						<th data-column-id="color">color</th>
						<th data-column-id="size">size</th>
						<th data-column-id="commands" data-formatter="commands" data-sortable="false">Action</th>
					</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<?=$create_clothes;?>


<script type="text/javascript" language="javascript" >
    $(document).ready(function(){

        var clothesTable = $('#clothes_data').bootgrid({
            ajax:true,
            rowSelect: true,
            post:function()
            {
                return{
                    id:"b0df282a-0d67-40e5-8558-c9e93b7befed"
                }
            },
            url:"<?php echo base_url(); ?>clothes/fetch_data",
            formatters:{
                "commands":function(column, row)
                {
                    return "<button type='button' class='btn btn-warning btn-xs update' data-row-id='"+row.product_id+"'>Edit</button>" + "&nbsp; <button type='button' class='btn btn-danger btn-xs delete' data-row-id='"+row.product_id+"'>Delete</button>";
                }
            }
        });

        $('#add_button').click(function(){
            $('#frmClothes')[0].reset();
            $('.modal-title').text("Add New");
            $('#action').val("Add");
            $('#operation').val("Add");
        });
        $('#add_button').click(function(){
            $('#frmClothes')[0].reset();
            $('.modal-title').text("Add New");
            $('#action').val("Add");
            $('#operation').val("Add");
        });

        $(document).on('submit', '#frmClothes', function(event){
            event.preventDefault();
            var id = $('#product_id').val();
            var name = $('#name').val();
            var address = $('#address').val();
            var gender = $('#gender').val();
            var designation = $('#designation').val();
            var age = $('#age').val();
            var form_data = $(this).serialize();
            if(name != '' && address != '' &&  gender != '' &&  designation != '' && age != '')
            {
                $.ajax({
                    url:"<?php echo base_url(); ?>clothes/action",
                    method:"POST",
                    data:form_data,
                    success:function(data)
                    {
                        $('#frmClothes')[0].reset();
                        $('#clothesModal').modal('hide');
                        $('#clothes_data').bootgrid('reload');
                    }
                });
            }
            else
            {
                alert("Please fill all required fields");
            }
        });

        $(document).on("loaded.rs.jquery.bootgrid", function(){
            clothesTable.find('.update').on('click', function(event){
                var id = $(this).data('row-id');
                $.ajax({
                    url:"<?php echo base_url(); ?>clothes/fetch_single_data",
                    method:"POST",
                    data:{id:id},
                    dataType:"json",
                    success:function(data)
                    {
                        $('#clothesModal').modal('show');
                        $('#name').val(data.name);
                        $('#product_code').val(data.product_code);
                        $('#short_description').val(data.short_description);
                        $('#cost').val(data.cost);
                        $('#selling_price').val(data.selling_price);
                        $('#brand_name').val(data.brand_name);
                        $('#color').val(data.color);
                        $('#size').val(data.size);
                        $('.modal-title').text("Edit Clothes");
                        $('#product_id').val(id);
                        $('#action').val('Save');
                        $('#operation').val('Edit');
                    }
                });
            });

            clothesTable.find('.delete').on('click', function(event){
                if(confirm("Are you sure you want to delete this?"))
                {
                    var id = $(this).data('row-id');
                    $.ajax({
                        url:"<?php echo base_url(); ?>clothes/delete_data",
                        method:"POST",
                        data:{id:id},
                        success:function(data)
                        {
                            $('#clothes_data').bootgrid('reload');
                        }
                    });
                }
                else
                {
                    return false;
                }
            });
        });

    });
</script>
