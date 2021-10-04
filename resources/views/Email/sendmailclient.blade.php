<!DOCTYPE html>
<html>
<head>
    <title>Artisto</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:hover {background-color: #f2f2f2;}
.c {
  width : 72px ;
  margin-top : 5px ;
}
</style>
</head>
<body>


<img src="http://localhost:8000/storage/img/logo.png" width="200" height="70"  >
<div>
<h4 style="text-align: center">Votre commande</h4>
<i><b>NB :</b>Votre commande est envoyé elle sera prête dans 10 jours maximum vous recevez 
    un message ou une appelle 
    téléphonique de la part de la société de la livraison pour plus d'information</i>
<table id="details">
  <thead>
    <tr>
      <th>Image</th>
      <th >Libelle</th>
      <th >Prix</th>
      <th>Quantité</th>
      <th>Couleur</th>
    </tr>
  </thead>
  <tbody>
  <tr>
                 @foreach($produit as $prod) 
                 <tr>
                   <img src="http://localhost:8000/storage/{{$prod['produit']['image']}}"width="100" height="100" >
                   <td>{{$prod['produit']['libelle']}} </td>
                   <td>{{$prod['produit']['prix']}}</td>
                   <td>{{$prod['qte']}}</td>
                   <td>
                   @foreach($prod['tab']  as $c) 
                   @if($c['tc'] != 'vide')
                    <div style="background-color: {{$c['tc']}};" class="c"> 
                    <p style="color: {{$c['tc']}};">   Référence </p>
                    </div>
                    @endif
                 @endforeach
                 </td>
                 <td>
                  @foreach($prod['tab']  as $c) 
                  @if($c['tc'] != 'vide')
                   <p> {{$c['qte']}}</p>
                   @endif
                @endforeach
                </td>
                </tr>
               @endforeach

                
  </tr>
  </tbody>
</table>
</div>

</body>
</html>