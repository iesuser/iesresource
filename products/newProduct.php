<?php
include("../block/globalVariables.php");
include("../block/db.php");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>ინვენტარი | ძიება</title>
		<link rel="stylesheet" href="../block/bootstrap-4.1.1-dist/css/bootstrap.min.css">
		<link href="../block/fontawesome-free-5.1.0-web/css/all.css" rel="stylesheet">
		<link href="../block/custom-bs4-styles.css" rel="stylesheet" type="text/css"/>
	</head>
	<body>
		<?php include("../block/mainmenu_bs.php");?>
		<div class="container-fluid">
			<div class="row border-bottom mb-5">
				<div class="col-md-3 border-right p-3" >
					<div class="card inventory-search-form">
	          <div class="card-header text-center">
	            <h6 class="mb-0">ძიება</h6>
	          </div>
	        	<div class="card-body">
							<div class="form-group">
								<label for="inventaris_nomeri">ინვენტარის ნომერი</label>
								<input type="text" class="form-control form-control-sm" name="inventaris_nomeri" id="inventaris_nomeri">
							</div>
							<div class="form-group">
								<label for="CPV">CPV</label>
								<input type="text" class="form-control form-control-sm" name="CPV" id="CPV"  maxlength="8">
							</div>
							<div class="form-group">
								<label for="ganyofileba">დეპარტამენტი</label>
								<?php
									mysqli_select_db($db, $dbStaff);	//მონაცემთა ბაზის გადართვა
	              ?>
								<select name="ganyofileba" id="ganyofileba" class="form-control form-control-sm" onchange="javascript:on_department_selected();">
	           			<option value=""></option>
					   			<?php
	                $table = mysqli_query($db, "SELECT id,name FROM departments ORDER by id ASC");
	                while($row = mysqli_fetch_array($table)){
	                	$name = $row["name"];
	                ?>
	               	<option value="<?php echo $name;?>"><?php echo $name;?></option>
	                <?php }  ?>
	             	</select>
							</div>
							<div class="form-group">
								<label for="jgufi_laboratoria">ჯგუფი/ლაბორატორია</label>
								<select name="jgufi_laboratoria" id="jgufi_laboratoria" class="form-control form-control-sm" onchange="javascript:on_laboratory_selected();">
	             	  <option value=""></option>
	           		</select>
							</div>
							<div class="form-group">
								<label for="pasuxismgebeli">პასუხისმგებელი პირი</label>
								<select name="pasuxismgebeli" id="pasuxismgebeli" class="form-control form-control-sm">
									<option value=""></option>
	                <option value= <?php {echo "selected='selected'";}?>><?php echo $pasuxismgebeli;?></option>
	              </select>
							</div>
							<div class="form-group">
								<label for="otaxis_nomeri">ოთახის ნომერი</label>
								<input type="text" class="form-control form-control-sm" name="otaxis_nomeri" id="otaxis_nomeri">
							</div>
							<div class="form-group">
								<label for="zomis_erteuli">ზომის ერთეული</label>
								<?php
	             	mysqli_select_db($db, $dbInventari);	//მონაცემთა ბაზის გადართვა
	              ?>
	              <select name="zomis_erteuli" id="zomis_erteuli" class="form-control form-control-sm">
	            	<option value=""></option>
	              <?php
								$table = mysqli_query($db, "SELECT name FROM zomis_erteuli");
								while($row = mysqli_fetch_array($table))
								{
									$name = $row["name"];
								?>
								  <option value="<?php echo $name; ?>" <?php if($zomis_erteuli == $name) echo "selected='selected'";?>><?php echo $name;?></option>
									<?php
									}
									?>
									</select>
							</div>
							<div class="form-group">
								<label for="tarigi_dan">თარიღი (დან)</label>
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<button class="btn btn-outline-secondary" type="button" id="button-tarigi-dan"><i class="far fa-calendar-alt"></i></button>
									</div>
									<input type="text" id="tarigi_dan" name="tarigi_dan" class="form-control datepicker" value="">
								</div>
							</div>
							<div class="form-group">
								<label for="tarigi_mde">თარიღი (მდე)</label>
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<button class="btn btn-outline-secondary" type="button" id="button-tarigi-mde"><i class="far fa-calendar-alt"></i></button>
									</div>
									<input type="text" id="tarigi_mde" name="tarigi_mde" class="form-control datepicker" value=""></div>
							</div>
							<div class="form-group">
								<label for="shesyidvis_tarigi_dan">შესყიდვის თარიღი (დან)</label>
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<button class="btn btn-outline-secondary" type="button" id="button-shesyidvis-tarigi-dan"><i class="far fa-calendar-alt"></i></button>
									</div>
									<input type="text" id="shesyidvis_tarigi_dan" name="shesyidvis_tarigi_dan" class="form-control datepicker" value=""></div>
							</div>
							<div class="form-group">
								<label for="shesyidvis_tarigi_mde">შესყიდვის თარიღი (მდე)</label>
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<button class="btn btn-outline-secondary" type="button" id="button-shesyidvis-tarigi-mde"><i class="far fa-calendar-alt"></i></button>
									</div>
									<input type="text" id="shesyidvis_tarigi_mde" name="shesyidvis_tarigi_mde" class="form-control datepicker" value=""></div>
							</div>
							<div class="form-group">
								<label for="chamoceris_tarigi_dan">ჩამოწერის თარიღი (დან)</label>
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<button class="btn btn-outline-secondary" type="button" id="button-chamoceris-tarigi-dan"><i class="far fa-calendar-alt"></i></button>
		              </div>
									<input type="text" id="chamoceris_tarigi_dan" name="chamoceris_tarigi_dan" class="form-control datepicker" value=""></div>
							</div>
							<div class="form-group">
								<label for="chamoceris_tarigi_mde">ჩამოწერის თარიღი (მდე)</label>
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
		                <button class="btn btn-outline-secondary" type="button" id="button-chamoceris-tarigi-mde"><i class="far fa-calendar-alt"></i></button>
		              </div>
									<input type="text" id="chamoceris_tarigi_mde" name="chamoceris_tarigi_mde" class="form-control datepicker" value=""></div>
							</div>
							<div class="form-group">
								<label for="gadacemis_tarigi_dan">გადაცემის თარიღი (დან)</label>
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
		                <button class="btn btn-outline-secondary" type="button" id="button-gadacemis-tarigi-dan"><i class="far fa-calendar-alt"></i></button>
		              </div>
									<input type="text" id="gadacemis_tarigi_dan" name="gadacemis_tarigi_dan" class="form-control datepicker" value=""></div>
							</div>
							<div class="form-group">
								<label for="gadacemis_tarigi_mde">გადაცემის თარიღი (მდე)</label>
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
		                <button class="btn btn-outline-secondary" type="button" id="button-gadacemis-tarigi-mde"><i class="far fa-calendar-alt"></i></button>
		              </div>
									<input type="text" id="gadacemis_tarigi_mde" name="gadacemis_tarigi_mde" class="form-control datepicker" value=""></div>
							</div>
							<div class="form-group">
								<label for="girebuleba_dan">ღირებულება (დან)</label>
								<input type="text" name="girebuleba_dan" id="girebuleba_dan" class="form-control form-control-sm">
							</div>
							<div class="form-group">
								<label for="girebuleba_mde">ღირებულება (მდე)</label>
								<input type="text" name="girebuleba_mde" id="girebuleba_mde" class="form-control form-control-sm">
							</div>
							<div class="form-group">
								<label for="narch_girebuleba_dan">ნარჩ. ღირებულება (დან)</label>
								<input type="text" name="narch_girebuleba_dan" id="narch_girebuleba_dan" class="form-control form-control-sm">
							</div>
							<div class="form-group">
								<label for="narch_girebuleba_mde">ნარჩ. ღირებულება (მდე)</label>
								<input type="text" name="narch_girebuleba_mde" id="narch_girebuleba_mde" class="form-control form-control-sm">
							</div>
							<div class="form-group">
								<label for="saboloo_girebuleba_dan">ღირებულება (ჯამში) - (დან)</label>
								<input type="text" name="saboloo_girebuleba_dan" id="saboloo_girebuleba_dan" class="form-control form-control-sm">
							</div>
							<div class="form-group">
								<label for="saboloo_girebuleba_mde">ღირებულება (ჯამში) - (მდე)</label>
								<input type="text" name="saboloo_girebuleba_mde" id="saboloo_girebuleba_mde" class="form-control form-control-sm">
							</div>
							<div class="form-group">
								<label for="raodenoba_dan">რაოდენობა (დან)</label>
								<input type="text" name="raodenoba_dan" id="raodenoba_dan" class="form-control form-control-sm">
							</div>
							<div class="form-group">
								<label for="raodenoba_mde">რაოდენობა (მდე)</label>
								<input type="text" name="raodenoba_mde" id="raodenoba_mde" class="form-control form-control-sm">
							</div>
							<div class="custom-control custom-checkbox mb-2">
								<input type="checkbox" class="custom-control-input" name="chamocerili_inventari" id="chamocerili_inventari">
								<label class="custom-control-label" for="chamocerili_inventari">ჩამოწერილი ინვენტარი</label>
							</div>
							<div class="custom-control custom-checkbox mb-3">
							  <input type="checkbox" class="custom-control-input" id="gadacerili_inventari" name="gadacerili_inventari">
							  <label class="custom-control-label" for="gadacerili_inventari">გადაწერილი ინვენტარი</label>
							</div>
							<button class="btn btn-sm btn-unique btn-block" type="button" onclick="clean_inventory_search_form()"><i class="fas fa-eraser" style="color: #888484;"></i>&nbsp გასუფთავება</button>
							<button class="btn btn-sm btn-primary btn-block" type="submit" id="editbutton" onclick="load_data()"><i class="fas fa-search"></i>&nbsp ძიება</button>
						</div>
					</div>
				</div>
				<div class="col-md-9 p-3">
					<div id="loader" class="text-center" style="display: none;"><i class="fa fa-spinner fa-spin mt-5" style="font-size:48px;color: #007bff"></i></div>
					<div clas="container-fluid text-center" id="container-inventory-result-table"></div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="../block/bootstrap-4.1.1-dist/js/jquery-3.3.1.min.js"></script>
		<script type='text/javascript' src="../block/bootstrap-4.1.1-dist/js/popper.min.js"></script>
		<script type='text/javascript' src="../block/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
		<script type='text/javascript' src="../block/jQuery-Mask-Plugin-master/dist/jquery.mask.min.js"></script>
		<script src="../block/js-cookie-master/src/js.cookie.js"></script>

		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.2/b-colvis-1.5.1/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/cr-1.5.0/r-2.2.2/datatables.min.css"/>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.2/b-colvis-1.5.1/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/cr-1.5.0/r-2.2.2/datatables.min.js"></script>

		<script type="text/javascript" src="../block/mask.js"></script>
		<script type='text/javascript' src="products.js"></script>


	</body>
	<link rel="stylesheet" type="text/css" href="../block/jqplugins/datetimepicker/jquery.datetimepicker.min.css"/ >
	<script src="../block/jqplugins/datetimepicker/jquery.datetimepicker.full.min.js"></script>
</html>
