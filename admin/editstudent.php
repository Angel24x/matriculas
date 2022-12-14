<?php 
  $corepage = explode('/', $_SERVER['PHP_SELF']);
    $corepage = end($corepage);
    if ($corepage!=='index.php') {
      if ($corepage==$corepage) {
        $corepage = explode('.', $corepage);
       header('Location: index.php?page='.$corepage[0]);
     }
    }
    
    $id = base64_decode($_GET['id']);
    $oldPhoto = base64_decode($_GET['photo']);

  if (isset($_POST['updatestudent'])) {
  	$name = $_POST['name'];
  	$roll = $_POST['roll'];
  	$edad = $_POST['edad'];
  	$representante = $_POST['representante'];
  	$sexo = $_POST['sexo'];
  	$address = $_POST['address'];
  	$pcontact = $_POST['pcontact'];
  	$class = $_POST['class'];
  	
  	if (!empty($_FILES['photo']['name'])) {
  		 $photo = $_FILES['photo']['name'];
	  	 $photo = explode('.', $photo);
		 $photo = end($photo); 
		 $photo = $roll.date('Y-m-d-m-s').'.'.$photo;
  	}else{
  		$photo = $oldPhoto;
  	}
  	
  	$query = "UPDATE student_info SET name='$name', roll='$roll', class='$class',edad='$edad',representante='$representante', sexo='$sexo',city='$address', pcontact='$pcontact', photo='$photo' WHERE id=$id";
  	if (mysqli_query($db_con,$query)) {
  		$datainsert['insertsucess'] = '<p style="color: green;">Student Updated!</p>';
		if (!empty($_FILES['photo']['name'])) {
			move_uploaded_file($_FILES['photo']['tmp_name'], 'images/'.$photo);
			unlink('images/'.$oldPhoto);
		}	
  		header('Location: index.php?page=all-student&edit=success');
  	}else{
  		header('Location: index.php?page=all-student&edit=error');
  	}
  }
?>
<h1 class="text-primary"><i class="fas fa-user-plus"></i>  Editar Información de Estudiante<small class="text-warning"> Editar</small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
     <li class="breadcrumb-item" aria-current="page"><a href="index.php">Panel de Control </a></li>
     <li class="breadcrumb-item" aria-current="page"><a href="index.php?page=all-student">Todos los Estudiantes </a></li>
     <li class="breadcrumb-item active" aria-current="page">Agregar Estudiante</li>
  </ol>
</nav>

	<?php
		if (isset($id)) {
			$query = "SELECT * FROM `student_info` WHERE `id`=$id";
			$result = mysqli_query($db_con,$query);
			$row = mysqli_fetch_array($result);
		}
	 ?>
<div class="row">
<div class="col-sm-6">
	<form enctype="multipart/form-data" method="POST" action="">
		<div class="form-group">
		    <label for="name">Nombre de Estudiante</label>
		    <input name="name" type="text" class="form-control" id="name" value="<?php echo $row['name']; ?>" required="">
	  	</div>
	  	<div class="form-group">
		    <label for="roll">Número de Matrícula</label>
		    <input name="roll" type="text" class="form-control" pattern="[0-9]{8}" id="roll" value="<?php echo $row['roll']; ?>" required="">
	  	</div>
		  <div class="form-group">
		    <label for="edad">Edad del estudiante </label>
		    <input name="edad" type="text" class="form-control" pattern="[0-9]{1,2}" id="edad" value="<?php echo $row['edad']; ?>" required="" maxlength="2">
	  	</div>
		  <div class="form-group">
		    <label for="representante">Representante de Estudiante</label>
		    <input name="representante" type="text" class="form-control" id="representante" value="<?php echo $row['representante']; ?>" required="" maxlength="20">
	  	</div>
		  <div class="form-group">
		    <label for="class">Sexo</label>
		    <select name="sexo" class="form-control" id="sexo" required="" value="">
		    	<option value="F" <?= $row['sexo']=='F'? 'selected':'' ?>>Femenino</option>
				<option value="M" <?= $row['sexo']=='M'? 'selected':'' ?>>Masculino</option>
		    </select>
	  	</div>
	  	<div class="form-group">
		    <label for="address">Dirección de Estudiante</label>
		    <input name="address" type="text" class="form-control" id="address" value="<?php echo $row['city']; ?>" required="">
	  	</div>
	  	<div class="form-group">
		    <label for="pcontact">Número de Contacto</label>
		    <input name="pcontact" type="text" class="form-control" id="pcontact" value="<?php echo $row['pcontact']; ?>" pattern="[0-9]{10}" placeholder="+58..." required="">
	  	</div>
	  	<div class="form-group">
		    <label for="class">Grado</label>
		    <select name="class" class="form-control" id="class" required="" value="">
		    	<option value="Primero A" <?= $row['class']=='Primero A'? 'selected':'' ?>>Primero A</option>
				<option value="Primero B" <?= $row['class']=='Primero B'? 'selected':'' ?>>Primero B</option>
		    	<option value="Segundo A" <?= $row['class']=='Segundo A'? 'selected':'' ?>>Segundo A</option>
				<option value="Segundo B" <?= $row['class']=='Segundo B'? 'selected':'' ?>>Segundo B</option>
		    	<option value="Tercero A" <?= $row['class']=='Tercero A'? 'selected':'' ?>>Tercero A</option>
				<option value="Tercero B" <?= $row['class']=='Tercero B'? 'selected':'' ?>>Tercero B</option>
		    	<option value="Cuarto A" <?= $row['class']=='Cuarto A'? 'selected':'' ?>>Cuarto A</option>
				<option value="Cuarto B" <?= $row['class']=='Cuarto B'? 'selected':'' ?>>Cuarto B</option>
		    	<option value="Quinto A" <?= $row['class']=='Quinto A'? 'selected':'' ?>>Quinto A</option>
				<option value="Quinto B" <?= $row['class']=='Quinto B'? 'selected':'' ?>>Quinto B</option>
		    	<option value="Sexto A" <?= $row['class']=='Sexto A'? 'selected':'' ?>>Sexto A</option>
				<option value="Sexto B" <?= $row['class']=='Sexto B'? 'selected':'' ?>>Sexto B</option>
		    </select>
	  	</div>
	  	<div class="form-group">
		    <label for="photo">Fotografía</label>
		    <input name="photo" type="file" class="form-control" id="photo">
	  	</div>
	  	<div class="form-group text-center">
		    <input name="updatestudent" value="Editar Estudiante" type="submit" class="btn btn-danger">
	  	</div>
	 </form>
</div>
</div>