<?php 
  $corepage = explode('/', $_SERVER['PHP_SELF']);
    $corepage = end($corepage);
    if ($corepage!=='index.php') {
      if ($corepage==$corepage) {
        $corepage = explode('.', $corepage);
       header('Location: index.php?page='.$corepage[0]);
     }
    }

  if (isset($_POST['addstudent'])) {
  	$name = $_POST['name'];
  	$roll = $_POST['roll'];
  	$class = $_POST['class'];
  	$edad = $_POST['edad'];
  	$sexo = $_POST['sexo'];
  	$representante = $_POST['representante'];
  	$address = $_POST['address'];
  	$pcontact = $_POST['pcontact'];
  	
  	$photo = explode('.', $_FILES['photo']['name']);
  	$photo = end($photo); 
  	$photo = $roll.date('Y-m-d-m-s').'.'.$photo;

  	$query = "INSERT INTO `student_info`(`name`, `roll`, `class`, `edad`,`representante`,`sexo`,`city`, `pcontact`, `photo`) VALUES ('$name', '$roll', '$class', '$edad', '$representante','$sexo', '$address', '$pcontact','$photo');";
  	if (mysqli_query($db_con,$query)) {
  		$datainsert['insertsucess'] = '<p style="color: green;">Estudiante Ingresado Exitosamente</p>';
  		move_uploaded_file($_FILES['photo']['tmp_name'], 'images/'.$photo);
		  header('Location: index.php?page=all-student&create=success');
  	}else{
		header('Location: index.php?page=all-student&create=error');
  		$datainsert['inserterror']= '<p style="color: red;">Estudiante no ingresado, revise la información diligenciada.</p>';
  	}
  }
?>
<h1 class="text-primary"><i class="fas fa-user-plus"></i>  Agregar Estudiante<small class="text-warning"> Nuevo Estudiante</small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
     <li class="breadcrumb-item" aria-current="page"><a href="index.php">Panel de Control </a></li>
     <li class="breadcrumb-item active" aria-current="page">Agregar Estudiante</li>
  </ol>
</nav>

<div class="row">
	
<div class="col-sm-6">
		<?php if (isset($datainsert)) {?>
	<div role="alert" aria-live="assertive" aria-atomic="true" class="toast fade" data-autohide="true" data-animation="true" data-delay="2000">
	  <div class="toast-header">
	    <strong class="mr-auto">Student Insert Alert</strong>
	    <small><?php echo date('d-M-Y'); ?></small>
	    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
	      <span aria-hidden="true">&times;</span>
	    </button>
	  </div>
	  <div class="toast-body">
	    <?php 
	    	if (isset($datainsert['insertsucess'])) {
	    		echo $datainsert['insertsucess'];
	    	}
	    	if (isset($datainsert['inserterror'])) {
	    		echo $datainsert['inserterror'];
	    	}
	    ?>
	  </div>
	</div>
		<?php } ?>
	<form enctype="multipart/form-data" method="POST" action="">
		<div class="form-group">
		    <label for="name">Nombre de Estudiante</label>
		    <input name="name" type="text" class="form-control" id="name" value="<?= isset($name)? $name: '' ; ?>" required="">
	  	
	  	<div class="form-group">
		    <label for="roll">Número de Matrícula</label>
		    <input name="roll" type="text" value="<?= isset($roll)? $roll: '' ; ?>" class="form-control" pattern="[0-9]{8}" id="roll" required="">
	  	</div>
	  	<div class="form-group">
		    <label for="address">Dirección de Estudiante</label>
		    <input name="address" type="text" value="<?= isset($address)? $address: '' ; ?>" class="form-control" id="address" required="">
	  	</div>
	  	<div class="form-group">
		    <label for="pcontact">Teléfono de Contacto</label>
		    <input name="pcontact" type="text" class="form-control" id="pcontact" pattern="[0-9]{10,11}" value="<?= isset($pcontact)? $pcontact: '' ; ?>" placeholder="+58........." required="">
	  	</div>
	  	<div class="form-group">
		    <label for="class">Grado Estudiantil</label>
		    <select name="class" class="form-control" id="class" required="">
		    	<option>Selecciona</option>
		    	<option value="Primero A">Primero A</option>
				<option value="Primero B">Primero B</option>
		    	<option value="Segundo A">Segundo A</option>
				<option value="Segundo B">Segundo B</option>
		    	<option value="Tercero A">Tercero A</option>
				<option value="Tercero B">Tercero B</option>
		    	<option value="Cuarto A">Cuarto A</option>
				<option value="Cuarto B">Cuarto B</option>
		    	<option value="Quinto A">Quinto A</option>
				<option value="Quinto B">Quinto B</option>
		    	<option value="Sexto A">Sexto A</option>
				<option value="Sexto B">Sexto B</option>
		    </select>
	  	</div>
		  <div class="form-group">
		    <label for="edad">edad</label>
		    <input name="edad" type="number" value="<?= isset($edad)? $edad: '' ; ?>" class="form-control" pattern="[0-9]{2}" id="edad" required="">
	  	</div>
		  <div class="form-group">
		    <label for="representante">representante</label>
		    <input name="representante" type="text" value="<?= isset($edad)? $edad: '' ; ?>" class="form-control" pattern="[0-9]{2}" id="edad" required="">
	  	</div>
		  <div class="form-group">
		    <label for="class">Sexo</label>
		    <select name="sexo" class="form-control" id="sexo" required="">
		    	<option>Selecciona</option>
		    	<option value="M">Masculino</option>
		    	<option value="F">Femenino</option>
				
		    </select>
	  	</div>
	  	<div class="form-group">
		    <label for="photo">Fotografía de Estudiante</label>
		    <input name="photo" type="file" class="form-control" id="photo" required="">
	  	</div>
	  	<div class="form-group text-center">
		    <input name="addstudent" value="Agregar Estudiante" type="submit" class="btn btn-danger">
	  	</div>
	 </form>
</div>
</div>
<a href="matriculas.php">Ir a Pagina de Busqueda</a>