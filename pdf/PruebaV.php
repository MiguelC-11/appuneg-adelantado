<?php

require('./fpdf.php');



class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {
      //include '../../recursos/Recurso_conexion_bd.php';//llamamos a la conexion BD



      //$consulta_info = $conexion->query(" select *from info ");//traemos datos de la empresa desde BD
      //$dato_info = $consulta_info->fetch_object();
      $this->Image('logopdf.png', 185, 5, 20); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(45); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      $this->Cell(110, 15, utf8_decode('CUERPO DE BOMBEROS UNEG'), 1, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Ln(3); // Salto de línea
      $this->SetTextColor(103); //color

      /* UBICACION */
      $this->Cell(110);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(96, 10, utf8_decode("Ubicación : "), 0, 0, '', 0);
      $this->Ln(5);

      /* TELEFONO */
      $this->Cell(110);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(59, 10, utf8_decode("Teléfono : "), 0, 0, '', 0);
      $this->Ln(5);

      /* COREEO */
      $this->Cell(110);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode("Correo : "), 0, 0, '', 0);
      $this->Ln(5);

      /* TELEFONO */
      $this->Cell(110);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode("Sucursal : "), 0, 0, '', 0);
      $this->Ln(10);

      /* TITULO DE LA TABLA */
      //color
      $this->SetTextColor(228, 100, 0);
      $this->Cell(50); // mover a la derecha
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode("REPORTE DE HABITACIONES "), 0, 1, 'C', 0);
      $this->Ln(7);

      /* CAMPOS DE LA TABLA */
      //color
      $this->SetFillColor(228, 100, 0); //colorFondo
      $this->SetTextColor(255, 255, 255); //colorTexto
      $this->SetDrawColor(163, 163, 163); //colorBorde
      $this->SetFont('Arial', 'B', 11);
      $this->Cell(18, 10, utf8_decode('Nombre'), 1, 0, 'C', 1);
      $this->Cell(20, 10, utf8_decode('Sangre'), 1, 0, 'C', 1);
      $this->Cell(30, 10, utf8_decode('C.I'), 1, 0, 'C', 1);
      $this->Cell(25, 10, utf8_decode('Lugar de nacimiento'), 1, 1, 'C', 1);
      $this->Cell(70, 10, utf8_decode('Fecha de nacimiento'), 1, 0, 'C', 1);
      $this->Cell(25, 10, utf8_decode('Licencia'), 1, 0, 'C', 1);
      $this->Cell(25, 10, utf8_decode('Estado civil'), 1, 0, 'C', 1);
      $this->Cell(25, 10, utf8_decode('Peso'), 1, 0, 'C', 1);
      $this->Cell(25, 10, utf8_decode('altura'), 1, 0, 'C', 1);
      $this->Cell(25, 10, utf8_decode('direccion'), 1, 0, 'C', 1);
      $this->Cell(25, 10, utf8_decode('Carrera'), 1, 0, 'C', 1);
      $this->Cell(25, 10, utf8_decode('¿Trabaja?'), 1, 0, 'C', 1);
      $this->Cell(25, 10, utf8_decode('Lugar de trabajo'), 1, 1, 'C', 1);
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
      $hoy = date('d/m/Y');
      $this->Cell(355, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
}

$con = mysqli_connect("localhost", "root", "", "appbomberos");

 if(mysqli_connect_errno()){
     echo "conexion fallida" . mysqli_connect_errno();
 }




/* CONSULTA INFORMACION DEL HOSPEDAJE */
$fetch = mysqli_query($con, "select * from info");
$row = mysqli_num_rows($fetch);

$pdf = new PDF();
$pdf->AddPage(); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$i = 0;
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163); //colorBorde

if($row > 0) {
   while($r = mysqli_fetch_array($fetch)){

 $pdf->Cell(18, 10, utf8_decode($r['nombre']), 1, 0, 'C', 0);
$pdf->Cell(20, 10, utf8_decode($r['sangre']), 1, 0, 'C', 0);
$pdf->Cell(30, 10, utf8_decode($r['cedula']), 1, 0, 'C', 0);
$pdf->Cell(25, 10, utf8_decode($r['lugar_nac']), 1, 1, 'C', 0);
$pdf->Cell(70, 10, utf8_decode($r['fecha_nac']), 1, 0, 'C', 0);
$pdf->Cell(25, 10, utf8_decode($r['licencia']), 1, 0, 'C', 0);
$pdf->Cell(25, 10, utf8_decode($r['estado_civil']), 1, 0, 'C', 0);
$pdf->Cell(25, 10, utf8_decode($r['peso']), 1, 0, 'C', 0);
$pdf->Cell(25, 10, utf8_decode($r['altura']), 1, 0, 'C', 0);
$pdf->Cell(25, 10, utf8_decode($r['direccion']), 1, 0, 'C', 0);
$pdf->Cell(25, 10, utf8_decode($r['carrera']), 1, 0, 'C', 0);
$pdf->Cell(25, 10, utf8_decode($r['trabaja']), 1, 0, 'C', 0);
$pdf->Cell(25, 10, utf8_decode($r['lugar_trabajo']), 1, 1, 'C', 0);


    }  }

$i = $i + 1;
/* TABLA */



$pdf->Output('Prueba.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)
