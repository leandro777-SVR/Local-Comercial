<?php
// controlador/generarPdfController.php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../index.php");
    exit();
}

require_once '../config/conexion.php';
// Dejamos la ruta que sabemos que existe en tu computadora
require_once '../fpdf186/fpdf.php';

$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : 'semanal';

$titulo = "Reporte de Ventas";
$condicion_sql = "";

if ($tipo == 'semanal') {
    $titulo = "Reporte Semanal (Últimos 7 días)";
    $condicion_sql = "DATE(v.fecha_hora) >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
} elseif ($tipo == 'mensual') {
    $titulo = "Reporte Mensual (" . date('m/Y') . ")";
    $condicion_sql = "MONTH(v.fecha_hora) = MONTH(CURDATE()) AND YEAR(v.fecha_hora) = YEAR(CURDATE())";
} elseif ($tipo == 'anual') {
    $titulo = "Reporte Anual (" . date('Y') . ")";
    $condicion_sql = "YEAR(v.fecha_hora) = YEAR(CURDATE())";
} else {
    die("Tipo de reporte no válido");
}

$sql = "SELECT v.id_ventas, v.fecha_hora, v.total, c.nombre, c.apellido 
        FROM ventas v 
        LEFT JOIN clientes c ON v.id_clientes = c.id_clientes 
        WHERE $condicion_sql 
        ORDER BY v.fecha_hora DESC";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$ventas = $stmt->fetchAll();

// FUNCIÓN MODERNA PARA LOS TILDES (Reemplaza a utf8_decode)
function tilde($texto) {
    return mb_convert_encoding($texto, 'ISO-8859-1', 'UTF-8');
}

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',16);
        $this->Cell(0,10,tilde('Despensa Oscar Flores'),0,1,'C');
        $this->SetFont('Arial','I',10);
        $this->Cell(0,5,tilde('Sistema de Gestión Minimarket (TUP)'),0,1,'C');
        $this->Ln(10);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,tilde('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,tilde($titulo),0,1,'C');
$pdf->Ln(5);

$pdf->SetFillColor(200,200,200);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(20,10,'Ticket',1,0,'C',true);
$pdf->Cell(45,10,'Fecha y Hora',1,0,'C',true);
$pdf->Cell(80,10,'Cliente',1,0,'C',true);
$pdf->Cell(45,10,'Total',1,1,'C',true);

$pdf->SetFont('Arial','',10);
$gran_total = 0;

foreach($ventas as $v) {
    $cliente = $v['nombre'] ? $v['nombre'].' '.$v['apellido'] : 'Consumidor Final';
    
    $pdf->Cell(20,10,$v['id_ventas'],1,0,'C');
    $pdf->Cell(45,10,$v['fecha_hora'],1,0,'C');
    $pdf->Cell(80,10,tilde($cliente),1,0,'L');
    $pdf->Cell(45,10,'$'.number_format($v['total'], 2, ',', '.'),1,1,'R');
    
    $gran_total += $v['total'];
}

$pdf->Ln(2); 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(145,10,'TOTAL RECAUDADO EN EL PERIODO:',1,0,'R');
$pdf->Cell(45,10,'$'.number_format($gran_total, 2, ',', '.'),1,1,'R');

$pdf->Output('I', 'Reporte_Ventas.pdf');
?>