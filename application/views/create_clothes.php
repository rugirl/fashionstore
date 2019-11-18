<div id="clothesModal" class="modal fade">
	<div class="modal-dialog">
		<?php
		$attributes = array('id' => 'frmClothes', 'class' => 'form', 'role' => 'form', 'method' => 'post');
		echo form_open('clothes/create', $attributes);
		$label_attributes = array('class' => 'col-lg-3 col-form-label form-control-label');
		?>
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add New</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="form-group row">
					<?php
					echo form_label('Name*', 'name', $label_attributes); ?>
					<div class="col-lg-9">
						<?php
						$form_data = array('type' => 'text', 'name' => 'name', 'id' => 'name',
							'class' => 'form-control', 'required' => '');
						echo form_input($form_data); ?>
					</div>
					<div class="invalid-feedback">Please insert the name.</div>
				</div>
				<div class="form-group row">
					<?php
					echo form_label('Product Code*', 'name', $label_attributes); ?>
					<div class="col-lg-9">
						<?php
						$form_data = array('type' => 'text', 'name' => 'product_code', 'id' => 'product_code',
							'class' => 'form-control', 'required' => '');
						echo form_input($form_data); ?>
					</div>
					<div class="invalid-feedback">Please insert the Product Code.</div>
				</div>
				<div class="form-group row">
					<?php
					echo form_label('Short Description', 'short_description', $label_attributes); ?>
					<div class="col-lg-9">
						<?php
						$data = array(
							'name' => 'short_description',
							'id' => 'short_description',
							'rows' => '5',
							'cols' => '10',
							'class' => 'form-control',

						);
						echo form_textarea($data);
						?>

					</div>
					<div class="invalid-feedback">Please insert the Short Description.</div>
				</div>
				<div class="form-group row">
					<?php
					echo form_label('Cost*', 'cost', $label_attributes); ?>
					<div class="col-lg-9">
						<?php
						$form_data = array('type' => 'text', 'name' => 'cost', 'id' => 'cost',
							'class' => 'form-control', 'required' => '');
						echo form_input($form_data); ?>
					</div>
					<div class="invalid-feedback">Please insert the Cost.</div>
				</div>
			</div>
			<div class="form-group row">
				<?php echo form_label('Brand*', 'brand_id', $label_attributes); ?>
				<div class="col-lg-9">
					<?php
					$options = $brands;
					echo form_dropdown('brand_id', $options, '', 'class="form-control" name="brand_id" id="brand_id" size="0"');
					?>
				</div>
			</div>
			<div class="form-group row">
				<?php echo form_label('Color', 'color', $label_attributes); ?>
				<div class="col-lg-9">
					<?php
					$form_data = array('type' => 'text', 'name' => 'color', 'id' => 'color',
						'class' => 'form-control');
					echo form_input($form_data); ?>
				</div>
				<div class="invalid-feedback">Please insert the Color.</div>
			</div>
			<div class="form-group row">
				<?php
				echo form_label('Size', 'size', $label_attributes); ?>
				<div class="col-lg-9">
					<?php
					$form_data = array('type' => 'text', 'name' => 'size', 'id' => 'size',
						'class' => 'form-control');
					echo form_input($form_data); ?>
				</div>
				<div class="invalid-feedback">Please insert the Size.</div>
			</div>

			<div class="modal-footer">
				<input type="hidden" name="product_id" id="product_id"/>
				<input type="hidden" name="operation" id="operation" value="Add"/>
				<input type="submit" name="action" id="action" class="btn btn-success" value="Add"/>
			</div>
		</div>
		</form>
	</div>
</div>

