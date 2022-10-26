<?php

require APPROOT . '/inc/fpdf/fpdf.php'; 

//die(var_dump($data));
//echo $data['usuario']->name;

class PDF extends FPDF
{            
            
            // Page header
            function Header()
            {   $currentdate = date("d-m-Y");
                // Logo
                //$this->Image(APPROOT . '/views/relatorios/logo.png',10,6,110);
                // Date
                $this->SetFont('Arial','B',10); 
                $this->Cell(120);
                $this->Cell(260,10, utf8_decode('Data de impressão:' . $currentdate),0,0,'C');                
                // Arial bold 15
                $this->SetFont('Arial','B',15);    
                // Title
                $this->Ln(20);
                // Move to the right
                $this->Cell(120);
                $this->Cell(30,10, utf8_decode("Listagem de Unifome Escolar"),0,0,'C');
                // Line break
                $this->Ln(20);                
            }

            // Page footer
            function Footer()
            {
                // Position at 1.5 cm from bottom
                $this->SetY(-15);
                // Arial italic 8
                $this->SetFont('Arial','I',8);
                // Page number
                $this->Cell(0,10,utf8_decode('Página ').$this->PageNo(),0,0,'C');                
            }
}

            
            $pdf = new PDF();     
            //$pdf->Image(APPROOT . '/views/relatorios/logo.png',10,6,110);             
            
            /* Aqui é a imagem 
               Para alterar o modelo, na pasta relatorios eu salvei um 
               powerpoint. é só abrir alterar e salvar como jpg
               por fim substituir a imagem certificado.jpg da pasta relatorios

               APAGAR
               https://stackoverflow.com/questions/25888281/how-do-i-add-a-new-font-to-a-fpdf
            */
            $image = APPROOT . '/views/relatorios/certificado.jpg';
                       
            $pdf->SetFont('Arial','B',8);
            $pdf->AddPage('L');   
            //$pdf->Image($image, 0, 0); 
            // 0,0 onde na margem esquerda inicia a imagem
            // 297,210 o tamanho da imagem
            
            $pdf->Image($image,0,0,297,210); 
            $pdf->SetTextColor(14,63,160);  
            $pdf->SetFont('Arial','B',20);
            $pdf->MultiCell(0,20,'CERTIFICAMOS QUE',0,'C');
            $pdf->AddFont('Birthstone','','Birthstone-Regular.php');
            $pdf->SetFont('Birthstone','',41);  
            $pdf->SetTextColor(14,63,160); 
            //$pdf->Ln();             
            $pdf->MultiCell(0,0,$data['usuario']->name,0,'C');
            $pdf->SetFont('Arial','B',20);
            /* $pdf->MultiCell(900,10,'
            Portador do CPF: ' . $data['usuario']->cpf . ' participou como aluno(a) do curso de:' . $data['curso']->nome_curso);       
           // . $data['curso']->nome_curso */
            
          
           $pdf->MultiCell(270,10,'
           Portador do CPF: ' . $data['usuario']->cpf . ' participou como aluno(a) do curso de: ' . $data['curso']->nome_curso,0, false);

            $pdf->Output("Relatorio.pdf",'I');  
                    
?>

