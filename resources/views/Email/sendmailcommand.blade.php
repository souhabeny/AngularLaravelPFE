<!DOCTYPE html>
<html>
<head>
    <title>Artisto</title>
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
<div>
<img src="http://localhost:8000/storage/img/logo.png" width="200" height="100" style="margin-left:300px" >
<h4 style="text-align: center">Commande à préparer</h4>
<table id="details">
  <thead>
    <tr>
      <th>Image</th>
      <th >Libelle</th>
      <th >Prix</th>
      <th>Quantité</th>
      <th>Couleur</th>
      <th>Quantité par couleur</th>
    </tr>
  </thead>
  <tbody>

    

  
        @foreach($details  as $detail) 
        <tr>
        <img src="http://localhost:8000/storage/{{$detail->image}}"width="100" height="100" >
               <td>{{$detail->libelle}} </td>
                <td>{{ round($detail->prix - (($detail->prix /100) * $detail->promo)) }}</td>
                <td>{{$detail->qtecommande}}</td>
                <td>
                @foreach($produit as $prod) 
                @if ($detail->idProduit == $prod['produit']['id'])
                @foreach($prod['tab']  as $c) 
                   @if($c['tc'] != 'vide')
                    <div style="background-color: {{$c['tc']}};" class="c"> 
                    <p style="color: {{$c['tc']}};">   Référence </p>
                    </div>
                    @endif
                 @endforeach
                @endif
                @endforeach
                </td>
                <td>
                  @foreach($produit as $prod) 
                  @if ($detail->idProduit == $prod['produit']['id'])
                  @foreach($prod['tab']  as $c) 
                     @if($c['tc'] != 'vide')
                     <p> {{$c['qte']}}</p>
                      @endif
                   @endforeach
                  @endif
                  @endforeach
                  </td>
        </tr>
         @endforeach

        

     

   
  </tbody>
</table>
</div>
</body>
</html>