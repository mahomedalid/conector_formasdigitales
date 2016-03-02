<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Factura</title>
<style type="text/css">
<!--
.Emisor_Nombre {					/* 01 -   */
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-weight: bold;
}
.Cliente_Detalle_TipoDatos {		/* 02 -   */
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
}
.Emisor_Detalle_Datos {				/* 03 -   */
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}

.Emisor_DatosOficiales {			/* 04 -   */
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.Folio_Factura_Tabla {
	border: medium solid #999999;
	margin: 0px;
	padding: 0px;
}
.Folio_Factura_Tabla_Celda1 {		/* 05 -   */
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
	color: #003366;
	border-top-color: #FFFFFF;
	border-right-color: #FFFFFF;
	border-bottom-color: #FFFFFF;
	border-left-color: #FFFFFF;
	border-top-width: thin;
	border-right-width: thin;
	border-bottom-width: thin;
	border-left-width: thin;
	border-top-style: none;
	border-right-style: solid;
	border-bottom-style: none;
	border-left-style: none;
	text-align: right;
}
.Folio_Factura_Tabla_Celda2 {		/*  */
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
	text-align: right;
	width: 150px;
	border: 2px solid #00A4B8;
}
.Folio_Factura_Tabla_Celda3 {		/*  */
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
	color: #003063;
	background-position: left;
	border-top-color: #999999;
	border-right-color: #FFFFFF;
	border-bottom-color: #999999;
	border-left-color: #999999;
	border-top-width: thin;
	border-right-width: thin;
	border-bottom-width: thin;
	border-left-width: thin;
	border-top-style: double;
	border-right-style: double;
	border-bottom-style: double;
	border-left-style: double;
}
.Folio_Factura_Tabla_Celda4 {		/*  */
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
	text-align: right;
	border: thin solid #00659C;
	width: 150px;
}


.Folio_Factura_Espacio {			/*  */
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 1px;
}
.Cliente_Tabla_Celda1 {				/*  */
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #FFFFFF;
	text-align: center;
	background-color: #00A4B8;
}
.Cliente_Detalle_Datos {			/*  */
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.Cliente_Tabla_Espacio {			/*  */
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 1px;
}
.Emisor_Detalle_TipoDatos {			/*  */
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
}
.Partidas_Tabla {
    thead display: table‐header‐group;
}

.Partidas_Encabezado {				/*  */
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
	color: #FFFFFF;
	text-align: center;
	background-color: #00A4B8;
	padding: 3px;
}
.Partidas_Detalle_Cantidad {		/*  */
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: normal;
	color: #000000;
	text-align: center;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 2px;
	border-right-color: #FFFFFF;
	border-left-color: #FFFFFF;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: solid;
	border-top-color: #FFFFFF;
	border-bottom-color: #FFFFFF;
	margin-bottom: 100px;
	line-height: 20px;
	padding: 3px;
	margin-top: 0px;
	margin-right: 0px;
	margin-left: 0px;
}
.Partidas_Detalle_Codigo {			/*  */
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: normal;
	color: #000000;
	text-align: center;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-right-color: #FFFFFF;
	border-left-color: #FFFFFF;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: solid;
	border-top-color: #FFFFFF;
	border-bottom-color: #FFFFFF;
	line-height: 20px;
	padding: 3px;
}
.Partidas_Detalle_Descripcion {		/*  */
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: normal;
	color: #000000;
	text-align: left;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-right-color: #FFFFFF;
	border-left-color: #FFFFFF;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: solid;
	border-top-color: #FFFFFF;
	border-bottom-color: #FFFFFF;
	line-height: 20px;
	padding: 3px;
}
.Partidas_Detalle_UM {				/*  */
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: normal;
	color: #000000;
	text-align: center;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-right-color: #FFFFFF;
	border-left-color: #FFFFFF;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: solid;
	border-top-color: #FFFFFF;
	border-bottom-color: #FFFFFF;
	line-height: 20px;
	padding: 3px;
}
.Partidas_Detalle_Unitario {		/*  */
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: normal;
	color: #000000;
	text-align: right;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-right-color: #FFFFFF;
	border-left-color: #FFFFFF;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: solid;
	border-top-color: #FFFFFF;
	border-bottom-color: #FFFFFF;
	line-height: 20px;
	padding: 3px;
}
.Partidas_Detalle_Importe {			/*  */
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: normal;
	color: #000000;
	text-align: right;
	border-top-width: 1px;
	border-right-width: 2px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-right-color: #FFFFFF;
	border-left-color: #FFFFFF;
	border-top-style: none;
	border-right-style: solid;
	border-bottom-style: none;
	border-left-style: solid;
	border-top-color: #FFFFFF;
	border-bottom-color: #FFFFFF;
	line-height: 20px;
	padding: 3px;
}
.Partidas_Detalle_IzqAbaj {			/*  */
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: normal;
	color: #000000;
	text-align: center;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 2px;
	border-left-width: 2px;
	border-right-color: #FFFFFF;
	border-left-color: #FFFFFF;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: solid;
	border-left-style: solid;
	border-top-color: #00A4B8;
	border-bottom-color: #00A4B8;
}
.Partidas_Detalle_CentAbaj {		/*  */
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: normal;
	color: #000000;
	text-align: left;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 2px;
	border-left-width: 1px;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: solid;
	border-top-color: #00A4B8;
	border-bottom-color: #00A4B8;
}
.Partidas_Detalle_DerAbaj {			/*  */
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: normal;
	color: #000000;
	text-align: center;
	border-top-width: 1px;
	border-right-width: 2px;
	border-bottom-width: 2px;
	border-left-width: 1px;
	border-right-color: #00A4B8;
	border-left-color: #00A4B8;
	border-top-style: none;
	border-bottom-style: solid;
	border-top-color: #00A4B8;
	border-bottom-color: #00A4B8;
}
.Partidas_Linea {					/*  */
	color: #000000;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}

.Total_ImporteLetra {				/*  */
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
	color: #333333;
}
.Total_FormaPago {					/*  */
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #333333;
}

.Total_FormaPagoTitulo {			/*  */
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #333333;
	font-weight: bold;
}

.Total_Certificado_Datos {			/*  */
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 8px;
	color: #333333;
}
.Total_Certificado_TipoDatos {		/*  */
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 8px;
	font-weight: bold;
	color: #333333;
}
.Total_Celda_Total {				/*  */
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #003063;
	text-align: right;
	vertical-align:middle;
	border-top-width: thin;
	border-right-width: thin;
	border-bottom-width: thin;
	border-left-width: thin;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
	border-top-color: #FFFFFF;
	border-right-color: #FFFFFF;
	border-bottom-color: #FFFFFF;
	border-left-color: #FFFFFF;
}
.Total_Celda_TotalImporte {			/*  */
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	text-align: right;
	color: #FFFFFF;
	background-color: #00A4B8;
	vertical-align:middle;
}
.Total_Celda_DesgloseImporte {		/*  */
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
	text-align: right;
	border: 2px solid #00A4B8;
	vertical-align:middle;
}
.Total_Celda_Desglose {				/*  */
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
	color: #003063;
	text-align: right;
	vertical-align:middle;
	border-top-color: #FFFFFF;
	border-right-color: #FFFFFF;
	border-bottom-color: #FFFFFF;
	border-left-color: #FFFFFF;
	border-top-width: thin;
	border-right-width: thin;
	border-bottom-width: thin;
	border-left-width: thin;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
}

.Total_Linea {						/*  */
	color="769FB8"
}

.SelloCadena {						/*  */
	font-family: Arial, Helvetica, sans-serif;
	font-size: 8px;
	color: #333333;
	text-align: left;
	vertical-align:middle;
	background-color: #E5E5E5;
}
.SelloCadenaTitulo {				/*  */
	font-family: Arial, Helvetica, sans-serif;
	font-size: 8px;
	color: #333333;
	text-align: left;
	vertical-align:middle;
	font-weight: bold;
	background-color: #E5E5E5;
}
.SelloLeyenda {						/*  */
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 8px;
	font-weight: bold;
	text-align: center;
	border: thin solid #CCCCCC;
	vertical-align:middle;
	background-color: #E5E5E5;
}
.Sello_Borde {						/*  */
	border: thin solid #999999;
}
-->
</style>
</head>
<body style="max-width: 900px; margin: 0 auto; padding-top: 10px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
		<td width="245" valign="top">
        	<img src="logos/<?php echo $factura->idCliente ?>.png" height="170px" name="Logotipo" id="Logotipo" />        </td>
<td width="525" valign="top">
<table width="100%" border="0" cellpadding="0" cellspacing="0" id="Emisor">
<tr>
					<td width="2%">&nbsp;</td>
			  <td width="95%">
			  	<p class="Emisor_Nombre" style="color:#6F2878"><?php echo $factura->xml_data->Emisor->nombre ?></p>
               	<p class="Emisor_Nombre"><?php echo $factura->xml_data->Emisor->nombre ?></p>
                        <p class="Emisor_Detalle_Datos">
							<?php echo $factura->xml_data->Emisor->Domicilio->calle ?>&nbsp;NO.&nbsp;
							<?php echo $factura->xml_data->Emisor->Domicilio->noExterior ?>&nbsp;
							INT.&nbsp;<?php echo $factura->xml_data->Emisor->Domicilio->noInterior ?><br />
							COLONIA:&nbsp;<?php echo $factura->xml_data->Emisor->Domicilio->colonia ?>&nbsp;
							C.P.:&nbsp;<?php echo $factura->xml_data->Emisor->Domicilio->codigoPostal ?><br />
                            <?php echo $factura->xml_data->Emisor->Domicilio->municipio ?>,&nbsp;
							<?php echo $factura->xml_data->Emisor->Domicilio->estado ?>.&nbsp;<?php echo $factura->xml_data->Emisor->Domicilio->pais ?><br />
                            RFC:&nbsp;<?php echo $factura->xml_data->Emisor->rfc ?><br />
                            <br />
                            <b>EXPEDIDO EN:</b><br />
                            <?php echo $factura->xml_data->LugarExpedicion ?><br />
					</td>
		  <td width="3%">&nbsp;</td>
		</tr>
			</table>
	</td>
		<td width="605" valign="top">
<table width="100%" border="0" cellpadding="5" cellspacing="0">
				<tr>
					<td class="Folio_Factura_Tabla_Celda1">Folio Fiscal:</td>
					<td class="Folio_Factura_Tabla_Celda2"><?php echo (string)$timbres[0]['UUID'] ?></td>
				</tr>
                <tr class="Folio_Factura_Espacio">
                	<td colspan="2" class="Folio_Factura_Espacio">&nbsp;</td>
				</tr>
				<tr>
					<td class="Folio_Factura_Tabla_Celda1"><?php echo $factura->xml_data->tipoDeComprobante ?>&nbsp;Control:</td>
					<td class="Folio_Factura_Tabla_Celda2"><?php echo $invoice_id ?></td>
				</tr>
                <tr class="Folio_Factura_Espacio">
                	<td colspan="2" class="Folio_Factura_Espacio">&nbsp;</td>
				</tr>
				<tr>
                	<td class="Folio_Factura_Tabla_Celda1">Fecha:</td>
                    <td class="Folio_Factura_Tabla_Celda2"><?php echo $factura->xml_data->fecha ?></td>
				</tr>
			</table>
		</td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="5" cellspacing="0" id="Receptor">
	<tr class="Cliente_Tabla_Espacio">
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class="Cliente_Tabla_Celda1">CLIENTE</td>
	</tr>
	<tr>
		<td>
        	<p>
				<span class="Cliente_Detalle_TipoDatos">NOMBRE:&nbsp;</span><span class="Cliente_Detalle_Datos"><?php echo $factura->xml_data->Receptor->nombre ?></span><br />
				<span class="Cliente_Detalle_TipoDatos">RFC:&nbsp;</span><span class="Cliente_Detalle_Datos"><?php echo $factura->xml_data->Receptor->rfc ?></span><br />
				<span class="Cliente_Detalle_TipoDatos">DIRECCIÓN:&nbsp;</span><span class="Cliente_Detalle_Datos"><?php echo $factura->xml_data->Receptor->Domicilio->calle ?>&nbsp;NO.&nbsp;<?php echo $factura->xml_data->Receptor->Domicilio->noExterior ?>&nbsp; INT.&nbsp;<?php echo $factura->xml_data->Receptor->Domicilio->noInterior ?><br /></span>
				<span class="Cliente_Detalle_TipoDatos">COLONIA:&nbsp;</span><span class="Cliente_Detalle_Datos"><?php echo $factura->xml_data->Receptor->Domicilio->colonia ?></span><br />
				<span class="Cliente_Detalle_TipoDatos">C.P.:&nbsp;</span><span class="Cliente_Detalle_Datos"><?php echo $factura->xml_data->Receptor->Domicilio->codigoPostal ?></span></p>
				<span class="Cliente_Detalle_TipoDatos">MUNICIPIO:&nbsp;</span><span class="Cliente_Detalle_Datos"><?php echo $factura->xml_data->Receptor->Domicilio->municipio ?></span><br />
				<span class="Cliente_Detalle_TipoDatos">ESTADO:&nbsp;</span><span class="Cliente_Detalle_Datos"><?php echo $factura->xml_data->Receptor->Domicilio->estado ?></span><br />
				<span class="Cliente_Detalle_TipoDatos">PAÍS:&nbsp;</span><span class="Cliente_Detalle_Datos"><?php echo $factura->xml_data->Receptor->Domicilio->pais ?></span><br />
				
		</td>
	</tr>
	<tr class="Cliente_Tabla_Espacio">
		<td>&nbsp;</td>
	</tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="Partidas_Tabla" id="Partidas">
 	<thead style="display: table-header-group">
	    </thead>
 	<tr>
 	  <th class="Partidas_Encabezado" scope="col">CANT.</th>
	    <th scope="col" width="13%" class="Partidas_Encabezado">CÓDIGO</th>
		<th scope="col" width="46%" class="Partidas_Encabezado">DESCRIPCIÓN</th>
	    <th scope="col" width="8%" class="Partidas_Encabezado">U.M.</th>
        <th scope="col" width="12%" class="Partidas_Encabezado">PRECIO<br />UNITARIO</th>
	    <th scope="col" width="13%" class="Partidas_Encabezado">IMPORTE</th>
	<td></thead></td>
    </tr>
 	<tbody>
 		<tr>
		    <td class="Partidas_Detalle_Cantidad">&nbsp;</td>
		    <td class="Partidas_Detalle_Codigo">&nbsp;</td>
		    <td class="Partidas_Detalle_Descripcion">&nbsp;</td>
		    <td class="Partidas_Detalle_UM">&nbsp;</td>
		    <td class="Partidas_Detalle_Unitario">&nbsp;</td>
		    <td class="Partidas_Detalle_Importe">&nbsp;</td>
		</tr>

        <?php foreach($factura->xml_data->Conceptos as $concepto) { ?>
		<tr id="partida_renglon" bordercolor="0" style="page-break-inside : avoid">
			<td class="Partidas_Detalle_Cantidad"><?php echo $concepto->cantidad ?></td>
			<td class="Partidas_Detalle_Codigo"><?php echo $concepto->sku ?></td>
			<td class="Partidas_Detalle_Descripcion"><?php echo $concepto->descripcion ?></td>
			<td class="Partidas_Detalle_UM"><?php echo $concepto->unidad ?></td>
			<td class="Partidas_Detalle_Unitario">$ <?php echo number_format($concepto->valorUnitario,2) ?></td>
			<td class="Partidas_Detalle_Importe">$ <?php echo number_format($concepto->importe,2) ?></td>
		</tr>
		<?php } ?>

		<tr style="page-break-inside : avoid">
			<td class="Partidas_Detalle_IzqAbaj">&nbsp;</td>
			<td class="Partidas_Detalle_CentAbaj">&nbsp;</td>
			<td class="Partidas_Detalle_CentAbaj">&nbsp;</td>
			<td class="Partidas_Detalle_CentAbaj">&nbsp;</td>
			<td class="Partidas_Detalle_CentAbaj">&nbsp;</td>
			<td class="Partidas_Detalle_DerAbaj">&nbsp;</td>
		</tr>
    </tbody>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" id="Totales" >
	<!-- tr>
		<br>
		<td colspan="2" valign="top">&nbsp;
			<span class="Total_FormaPagoTitulo">Observaciones:&nbsp;</span>
			<span class="Total_FormaPago">CC_OBSERVACIONES</span>
		</td>
		
	</tr -->
	<tr>
		<td colspan="2" valign="top"><hr class="Total_Linea" width="100%" size="1" noshade="noshade"/></td>
	</tr>
	<tr>
		<td width="70%" valign="top">
			<table width="80%" border="0" cellspacing="0" cellpadding="0">
				<tr class="Total_ImporteLetra">
					<td><br />
						
            <br />Importe con Letra:&nbsp;<?php 
				$numalet = new NumberToLetterConverter();
				
				echo $numalet->to_word($factura->xml_data->total, 'MXN'); 
			?><span class="Total_FormaPagoTitulo"><br />
            Forma de Pago:&nbsp;</span><span class="Total_FormaPago"><?php echo $factura->xml_data->formaDePago ?></span><br />
                <span class="Total_FormaPagoTitulo">Método de Pago:&nbsp;</span>
				<span class="Total_FormaPago"><?php echo $factura->xml_data->metodoDePago ?></span><br />   
				<span class="Total_FormaPagoTitulo">Número de cuenta:&nbsp;</span>				
				<span class="Total_FormaPago">-</span><br />            
				<span class="Total_Certificado_TipoDatos">No. de Serie del Certificado del SAT:&nbsp;</span>
				<span class="Total_Certificado_Datos"><?php echo $factura->xml_data->noCertificado ?><br />
                <!-- span class="Total_Certificado_TipoDatos">Fecha y Hora de Certificación:&nbsp;</span><span><?php echo $factura->xml_data->noCertificado ?></span -->
                <br>
                <span class="Total_Certificado_TipoDatos">Régimen Fiscal:&nbsp;<?php echo $factura->xml_data->Emisor->Regimen ?></span>				
                <p class="Total_ImporteLetra">Código de barras del timbre:<br />
                    <br />
                <img src="codigobarrastimbre.jpg" name="Logotipo" id="Logotipo3" /></p></td>
          </tr>
          
			</table>
		  <p>&nbsp;</p>
      </td>
  <td width="30%" align="right" valign="top">
    <table width="339" border="0" cellspacing="0" cellpadding="5" style="page-break-inside : avoid">
				<tr>
					<td class="Total_Celda_Desglose">Subtotal</td>
					<td class="Total_Celda_DesgloseImporte">$ <?php echo number_format($factura->xml_data->subTotal,2) ?></td>
				</tr>
					<tr class="Folio_Factura_Espacio">
                      <td colspan="2" class="Folio_Factura_Espacio">&nbsp;</td>
	    </tr>
				<tr>
					<td class="Total_Celda_Desglose">Descuento</td>
					<td class="Total_Celda_DesgloseImporte">$ 0.00</td>
				</tr>
				<tr class="Folio_Factura_Espacio">
					<td colspan="2" class="Folio_Factura_Espacio">&nbsp;</td>
				</tr>
				<?php 
				if(isset($factura->xml_data->Traslados)) {
				foreach($factura->xml_data->Traslados as $traslado) {
					?>
				<tr>
					<td class="Total_Celda_Desglose"><?php echo $traslado->impuesto ?> <?php echo $traslado->tasa ?>%</td>
					<td class="Total_Celda_DesgloseImporte">$ <?php echo $traslado->importe ?></td>
				</tr>
				
				<tr class="Folio_Factura_Espacio">
					<td colspan="2" class="Folio_Factura_Espacio">&nbsp;</td>
				</tr>
				<?php } 
				}?>
				
				<tr valign="middle">
					<td class="Total_Celda_Total">Total</td>
					<td class="Total_Celda_TotalImporte">$ <?php echo number_format($factura->xml_data->total, 2) ?></td>
				</tr>
	  </table>
	  </td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
	<tr style="page-break-inside : avoid">
		<td class="Sello_Borde">
			<table width="100%" border="0" cellpadding="3" cellspacing="0" id="Sello">
				<tr>
					<td class="SelloCadenaTitulo" width="100%">Sello del SAT:&nbsp;</td>
				</tr>
				<tr>
					<td class="SelloCadena"><?php echo (string)$timbres[0]['selloSAT'] ?></td>
				</tr>
				<tr>
					<td class="SelloCadenaTitulo" width="100%">Sello Digital del CFDI:</td>
				</tr>
				<tr>
					<td class="SelloCadena"><?php echo (string)$timbres[0]['selloCFD'] ?></td>
				</tr>
				<tr>
					<td class="SelloCadenaTitulo">Cadena Original del complemento de certificación digital del SAT:</td>
				</tr>
				<tr>
					<td class="SelloCadena"><?php echo (string)$factura->cadenaOriginal ?></td>
				</tr>
				<tr>
					<td class="SelloLeyenda">Este documento es una representación impresa de un CFDI</td>
				</tr>
				
			</table>
		</td>
	</tr>
</table>
<div style='margin: 0 auto;text-align: center;'>Generado con www.bepos.com.mx</div>
</body>
</html>
