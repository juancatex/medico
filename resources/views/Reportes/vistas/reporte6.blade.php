<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reporte 6</title>
</head>
<style>@page {
    margin: 0cm 0cm;
}

.body_wrapper {
    padding: 10px 20px 10px 20px;
    background: rgb(255, 255, 255) none;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    max-width: 750px;
    margin: 0 auto;

}

.table {
    border-collapse: collapse;
    width: 100%; 
    font-size: 12px;
    border: 1px solid;     

}
.table th,.table td {
  border: 1px solid black;
}
 
p {
    text-align: justify;
    font-size: 16px;
}

span {
    font-weight: bold;
}

.span2 {
    font-size: 10px;
}

.derecha {
    text-align: right;
}

header {
    position: fixed;
    top: 0cm;
    left: 0cm;
    right: 0cm;
    height: 1.8cm; 
}

footer {
    position: fixed;
    bottom: 0cm;
    left: 0cm;
    right: 0cm;
    height: 1.5cm; 
}

body {
    margin-top: 2.5cm;
    margin-left: 1.5cm;
    margin-right: 1.5cm;
    margin-bottom: 2cm;
    font-family: "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
     font-size: 12px;
}

</style>
<body >
<header> 
  <img src="{{ public_path('assets/img/header.png') }}" width="100%" height="100%">   
</header>
<footer>
 <img src="{{ public_path('assets/img/footer.png') }}" width="100%" height="100%">  
</footer>

    <main>
    <div class="body_wrapper">
        
        <h1 style="color: #0c49a5;text-align: center;">Reporte de pacientes con VIH</h1>
       
 
        <table class="table">
       <thead>
           <tr>
           <th>Nº</th>  
           <th class="align-middle" style="text-align: center;">Nombre </th>
            <th class="align-middle" style="text-align: center;">Carnet de identidad</th>
            <th class="align-middle" style="text-align: center;">Fecha Nacimiento</th>
            <th class="align-middle" style="text-align: center;">N° Historial Clinico</th>
            <th class="align-middle" style="text-align: center;">Control prenatal</th>
            <th class="align-middle" style="text-align: center;">Correo Electrónico</th>   
           </tr>
           
       </thead>
       <tbody>
           @php 
           $i=1; 
           @endphp
           @foreach ($data as $paciente)
           <tr>
               <td style="width:25px;text-align: center;">{{$i}}</td>  
                <td class="align-middle" style="text-align: center;">{{ $paciente->name}}</td>
                <td class="align-middle" style="text-align: center;">{{ $paciente->cip }}</td>
                <td class="align-middle" style="text-align: center;">{{ $paciente->fechanacimiento }}</td>
                <td class="align-middle" style="text-align: center;">{{ $paciente->numhisclinico }}</td>
                <td class="align-middle" style="text-align: center;">{{ $paciente->controlprenatalen }}</td>
                <td class="align-middle" style="text-align: center;">{{ $paciente->email }}</td> 
                 
           </tr>
           @php 
           $i=$i+1
           @endphp
           @endforeach
          
       </tbody>
   </table>
         
    </div>
    </main>
</body>
</html>