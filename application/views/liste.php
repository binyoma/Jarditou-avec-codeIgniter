<!DOCTYPE html>	
<html lang="fr">	
<head>	
<meta charset="UTF-8">	
<meta name="viewport" content="width=device-width, initial-scale=1.0,shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<title>CI - Affichage de la liste</title>	
</head>	
<body>
<div class="container">	
<div class="row">
   <div class="col-3">
        <img src="<?php echo base_url("assets//images//jarditou_logo.jpg"); ?>" class="img-fluid rounded float-left " alt="logo">
    </div>
    <div class="col-3">
    
    </div>
    <div class="col-6">
      <img src="<?php echo base_url("assets//images//promotion.jpg" ); ?>"class="img-fluid max-width: 100%  " alt="promotion">
    </div>

</div>
<div class="menu">
  <nav id="navbar" class="navbar navbar-expand-sm bg-dark navbar-dark">
    <!-- Toggler/collapsibe Button -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav">
              <li class="nav-item">
              <a  class="nav-link" href="<?php echo site_url("produits/liste"); ?>"> Accueil </a> 
              </li>
              <li class="nav-item">
                <a class="nav-link" href=" ">Mon compte</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="">contact </a>
              </li>
          </ul>
      </div> 
  </nav>
</div>

<h1><center>Liste des produits</center></h1>

<div class="row">
      <div class="col table-responsive ">
        <table class="table table-bordered table-striped ">
          <thead>
            <tr>
              <th><h5>Photo</h5></th>
              <th><h5>ID</h5></th>
              <th><h5>Réference</h5></th>
              <th><h5>Libellé</h5></th>
              <th><h5>Prix</h5></th>
              <th><h5>Stock</h5></th>
              <th><h5>Couleur</h5></th>
              <th><h5>Ajout</h5></th>
              <th><h5>Modif</h5></th>
            </tr>
          </thead>
<?php 
foreach ($liste_produits as $row) 
{
    echo"<tr>";
    echo "<td> <img src=". base_url("assets/images/$row->pro_id.$row->pro_photo")." width=70 height=50 alt=\"$row->pro_libelle\"></td>";
    echo"<td>".$row->pro_id."</td>";
    echo"<td>".$row->pro_ref."</td>";
    echo "<td><a href=".site_url("produits/detail/".$row->pro_id).">$row->pro_libelle</a> </td>";
    echo"<td>".$row->pro_prix."</td>";
    echo"<td>".$row->pro_stock."</td>";
    echo"<td>".$row->pro_couleur."</td>";
    echo"<td>".$row->pro_d_ajout."</td>";
    echo"<td>".$row->pro_d_modif."</td>";
    echo"</tr>";
}
?>
</table>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>	
</body>
</html