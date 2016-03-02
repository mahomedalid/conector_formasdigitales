<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Factura</title>
    
    <style>
    .invoice-box{
        max-width:800px;
        margin:auto;
        padding:30px;
        border:1px solid #eee;
        box-shadow:0 0 10px rgba(0, 0, 0, .15);
        font-size:15px;
        line-height:24px;
        font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color:#555;
    }
    
    .invoice-box table{
        width:100%;
        line-height:inherit;
        text-align:left;
    }
    
    .invoice-box table td{
        padding:5px;
        vertical-align:top;
    }
    
    .invoice-box table tr td:nth-child(2){
        text-align:right;
    }
    
    .invoice-box table tr.top table td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.top table td.title{
        font-size:45px;
        line-height:45px;
        color:#333;
    }
    
    .invoice-box table tr.information table td{
        padding-bottom:40px;
    }
    
    .invoice-box table tr.heading td{
        background:#eee;
        border-bottom:1px solid #ddd;
        font-weight:bold;
    }
    
    .invoice-box table tr.details td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom:1px solid #eee;
    }
    
    .invoice-box table tr.item.last td{
        border-bottom:none;
    }
    
    .invoice-box table tr.total td:nth-child(2){
        border-top:2px solid #eee;
        font-weight:bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td{
            width:100%;
            display:block;
            text-align:center;
        }
        
        .invoice-box table tr.information table td{
            width:100%;
            display:block;
            text-align:center;
        }
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="6">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="logos/<?php echo $factura->idCliente ?>.png" style="width:100%; max-width:170px; max-height: 170px;">
                            </td>
                            
                            <td>
                                <?php echo strtoupper($factura->xml_data->tipoDeComprobante) ?> <?php echo $invoice_id ?><br>
                                Fecha: <?php echo $factura->xml_data->fecha ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="6">
                    <table>
                        <tr>
                            <td>
                               <strong><?php echo $factura->xml_data->Emisor->nombre ?></strong><br />
								<?php echo $factura->xml_data->Emisor->Domicilio->calle ?>&nbsp;NO.&nbsp;
								<?php echo $factura->xml_data->Emisor->Domicilio->noExterior ?>&nbsp;
								INT.&nbsp;<?php echo $factura->xml_data->Emisor->Domicilio->noInterior ?><br />
								<?php echo $factura->xml_data->Emisor->Domicilio->colonia ?>&nbsp;
								C.P.&nbsp;<?php echo $factura->xml_data->Emisor->Domicilio->codigoPostal ?><br />
								<?php echo $factura->xml_data->Emisor->Domicilio->municipio ?>,&nbsp;
								<?php echo $factura->xml_data->Emisor->Domicilio->estado ?>.&nbsp;<?php echo $factura->xml_data->Emisor->Domicilio->pais ?><br />
								RFC:&nbsp;<?php echo $factura->xml_data->Emisor->rfc ?><br />
								<br />
								<b>EXPEDIDO EN:</b><br />
								<?php echo $factura->xml_data->LugarExpedicion ?><br />
                            </td>
                            
                            <td>
								
                                <strong><?php echo $factura->xml_data->Receptor->nombre ?></strong><br />
								
								<?php echo $factura->xml_data->Receptor->Domicilio->calle ?>&nbsp;NO.&nbsp;<?php echo $factura->xml_data->Receptor->Domicilio->noExterior ?>&nbsp; INT.&nbsp;<?php echo $factura->xml_data->Receptor->Domicilio->noInterior ?><br />
								<?php echo $factura->xml_data->Receptor->Domicilio->colonia ?>&nbsp;
								C.P.&nbsp;<?php echo $factura->xml_data->Receptor->Domicilio->codigoPostal ?><br />
								
								<?php echo $factura->xml_data->Receptor->Domicilio->municipio ?>, <?php echo $factura->xml_data->Receptor->Domicilio->estado ?>, <?php echo $factura->xml_data->Receptor->Domicilio->pais ?>
								<br />
								RFC: <?php echo $factura->xml_data->Receptor->rfc ?><br />
								<br />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                    Payment Method
                </td>
                
                <td>
                    Check #
                </td>
            </tr>
            
            <tr class="details">
                <td>
                    Check
                </td>
                
                <td>
                    1000
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                    CANT.
                </td>
                
                <td>C&Oacute;DIGO</td>
				<td>DESCRIPCI&Oacute;N</td>
				<td>U.M.</td>
				<td>PRECIO UNITARIO</td>
				<td>IMPORTE</td>
            </tr>
            
			<?php foreach($factura->xml_data->Conceptos as $concepto) { ?>
			<tr class="item">
				<td><?php echo $concepto->cantidad ?></td>
				<td><?php echo $concepto->sku ?></td>
				<td><?php echo $concepto->descripcion ?></td>
				<td><?php echo $concepto->unidad ?></td>
				<td>$ <?php echo number_format($concepto->valorUnitario,2) ?></td>
				<td>$ <?php echo number_format($concepto->importe,2) ?></td>
			</tr>
			<?php } ?>
            
            <tr class="total">
                <td colspan=5>
				Importe con letra: 
				<?php 
				$numalet = new NumberToLetterConverter();
				echo $numalet->to_word($factura->xml_data->total, 'MXN'); 
				?></td>
				
				<td>
                   Subtotal: $ <?php echo number_format($factura->xml_data->subTotal,2) ?>
                </td>
            </tr>
			
			<?php 
				if(isset($factura->xml_data->Traslados)) {
					foreach($factura->xml_data->Traslados as $traslado) {
						?>
					<tr class="total">
						<td colspan=5></td>
						<td><?php echo $traslado->impuesto ?> <?php echo $traslado->tasa ?>% : $ <?php echo number_format($traslado->importe,2) ?></td>
					</tr>
			<?php 	}		 
				}
			?>
			
			<tr class="total">
                <td colspan=5></td>
					<small>M&eacute;todo de pago: <?php echo $factura->xml_data->metodoDePago ?></small>
                <td>
                   Total: $ <?php echo number_format($factura->xml_data->total, 2) ?>
                </td>
            </tr>
			
			<tr>
				<td colspan=4></td>
				<td colspan=2><small><?php echo $factura->xml_data->formaDePago ?></small></td>
        </table>
		
		<div style='background: #000; color: #fff; font-weight: bold;'>Informaci&oacute;n del timbre fiscal</div>
		<div style="width: 300px; float: left;">
		</div>
		<div style="float: left;">
			<table>
				<tr>
					<td>Folio Fiscal</td>
					<td>Certificado Digital SAT</td>
					<td>Fecha de Certificaci&oacute;n</td>
				</tr>
				<tr>
					<td><?php echo (string)$timbres[0]['UUID'] ?></td>
					<td><?php echo $factura->xml_data->noCertificado ?></td>
					<td></td>
				</tr>
				
				<tr>
					<td colspan=3>Cadena original del timbre</td>
				</tr>
				
				<tr>
					<td colspan=3><?php echo (string)$factura->cadenaOriginal ?></td>
				</tr>
				
				<tr>
					<td colspan=3>Sello digital del emisor</td>
				</tr>
				
				<tr>
					<td colspan=3><?php echo (string)$timbres[0]['selloCFD'] ?></td>
				</tr>
				
				<tr>
					<td colspan=3>Sello digital del SAT</td>
				</tr>
				
				<tr>
					<td colspan=3><?php echo (string)$timbres[0]['selloSAT'] ?></td>
				</tr>
				
			</table>
		</div>
		<div style="clear: both;">&nbsp;</div>
		
		<div style='margin: 0 auto;text-align: center;'>Este documento es una representación impresa de un CFDI</a></div>
		<div style='margin: 0 auto;text-align: center;'>Generado con <a href="http://www.bepos.com.mx">www.bepos.com.mx</a></div>
    </div>
<br />	
                <span class="Total_Certificado_TipoDatos">Régimen Fiscal:&nbsp;<?php echo $factura->xml_data->Emisor->Regimen ?></span>				
			
			
</body>
</html>
