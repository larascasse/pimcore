function test() {
	console.log("TEST 1");


	// select printer to print on
	// for simplicity sake just use the first LabelWriter printer
	var printers = dymo.label.framework.getPrinters();
	if (printers.length == 0)
	    throw "No DYMO printers are installed. Install DYMO printers.";

	var printerName = "";
	for (var i = 0; i < printers.length; ++i)
	{
	    var printer = printers[i];
	    if (printer.printerType == "LabelWriterPrinter")
	    {
	        printerName = printer.name;
	        break;
	    }
	}

	if (printerName == "")
	    throw "No LabelWriter printers found. Install LabelWriter printer";


  var labelSetBuilder = new dymo.label.framework.LabelSetBuilder();



  var printers = dymo.label.framework.getPrinters();
  console.log("TEST2");

  for (var i = 0; i < printers.length; i++)
  {
        console.log("TEST3");
        var printer = printers[i];
      console.log(printer);

      // process each printer info as a separate label
      var record = labelSetBuilder.addRecord();

      // compose text data
      // use framework's text markup feature to set text formatting
      // because text markup is xml you can use any xml tools to compose it
      // here we will use simple text manipulations to avoid cross-browser compatibility.
      var info = "<font family='Courier New' size='14'>"; // default font
      info = info + "Printer: <b>" + printer.name + "n</b>"; 
      info = info + "PrinterType: " + printer.printerType;
      info = info + "n<font size='10'>is local: " + printer.isLocal;
      info = info + "nis online: " + printer.isConnected + "</font>";

      if (typeof printer.isTwinTurbo != "undefined")
      {
          if (printer.isTwinTurbo)
              info = info + "<i><u><br/>The printer is TwinTurbo!!!</u></i>";
          else
              info = info + "<font size='6'><br/>Oops, the printer is NOT TwinTurbo</font>";
      }

      if (typeof printer.isAutoCutSupported != "undefined")
      {
          if (printer.isAutoCutSupported)
              info = info + "<i><u><br/>The printer supports auto-cut!!!</u></i>";
          else
              info = info + "<font size='6'><br/>The printer does not supports auto-cut</font>";
      }

      else
              info = info + "<font size='6'><br/>The printer does not supports auto-cut</font>";

      info = info + "</font>";

      // when printing put info into object with name "Text"
      //record.setTextMarkup("Text", info);
      alert(info);
  }
}

function printLabelSmallEtiquette(labelContent,print) {
	alert(dymo);

	var labelSetBuilder = new dymo.label.framework.LabelSetBuilder();

	for (var content in labelContent) {
		var record = labelSetBuilder.addRecord();
		record.setText(labelContent.texte, "<?php echo $productName  ?>");
		record.setText(labelContent.codeBarre, "<?php echo $product->getEan()?>");
	}
	


  var printerName = "DYMO LabelWriter 4XL ok";
  var selectedprinter;
  var printers = dymo.label.framework.getPrinters();
  for (var i = 0; i < printers.length; i++)
  {
      var printer = printers[i];
      console.log(printer.name);
      if(printer.name==printerName)
          selectedPrinter=printer;

  }
  //var labelSet = new dymo.label.framework.LabelSetBuilder();
  label = dymo.label.framework.openLabelXml(labelXml_small);
   // process each printer info as a separate label
   // var record = labelSet.addRecord();

   // alert(label.getAddressObjectCount());

   // if(productName)
    //  record.setText("Nom",productName);


    //updatePreview();


    

     try
    {
      if(print)
        label.print(printerName,"",labelSetBuilder);
      //alert(labelSet.toString());
    }
    catch (e)
    {
        alert(e.message || e);
    }


}

var labelXml_small = '<?xml version="1.0" encoding="utf-8"?>' +
'<DieCutLabel Version="8.0" Units="twips">' +
'  <PaperOrientation>Landscape</PaperOrientation>' +
'  <Id>Address</Id>' +
'  <PaperName>99010 Address</PaperName>' +
'  <DrawCommands>' +
'    <RoundRectangle X="0" Y="0" Width="1581" Height="5040" Rx="270" Ry="270"/>' +
'  </DrawCommands>' +
'  <ObjectInfo>' +
'    <BarcodeObject>' +
'      <Name>codeBarre</Name>' +
'      <ForeColor Alpha="255" Red="0" Green="0" Blue="0"/>' +
'      <BackColor Alpha="0" Red="255" Green="255" Blue="255"/>' +
'      <LinkedObjectName></LinkedObjectName>' +
'      <Rotation>Rotation0</Rotation>' +
'      <IsMirrored>False</IsMirrored>' +
'      <IsVariable>True</IsVariable>' +
'      <Text>123456</Text>' +
'      <Type>Ean13</Type>' +
'      <Size>Small</Size>' +
'      <TextPosition>Bottom</TextPosition>' +
'      <TextFont Family="Arial" Size="7.3125" Bold="False" Italic="False" Underline="False" Strikeout="False"/>' +
'      <CheckSumFont Family="Arial" Size="7.3125" Bold="False" Italic="False" Underline="False" Strikeout="False"/>' +
'      <TextEmbedding>None</TextEmbedding>' +
'      <ECLevel>0</ECLevel>' +
'      <HorizontalAlignment>Left</HorizontalAlignment>' +
'      <QuietZonesPadding Left="0" Right="0" Top="0" Bottom="0"/>' +
'    </BarcodeObject>' +
'    <Bounds X="3259.652" Y="408.5744" Width="1618.767" Height="765.7087"/>' +
'  </ObjectInfo>' +
'  <ObjectInfo>' +
'    <TextObject>' +
'      <Name>Texte</Name>' +
'      <ForeColor Alpha="255" Red="0" Green="0" Blue="0"/>' +
'      <BackColor Alpha="0" Red="255" Green="255" Blue="255"/>' +
'      <LinkedObjectName></LinkedObjectName>' +
'      <Rotation>Rotation0</Rotation>' +
'      <IsMirrored>False</IsMirrored>' +
'      <IsVariable>True</IsVariable>' +
'      <HorizontalAlignment>Left</HorizontalAlignment>' +
'      <VerticalAlignment>Middle</VerticalAlignment>' +
'      <TextFitMode>ShrinkToFit</TextFitMode>' +
'      <UseFullFontHeight>True</UseFullFontHeight>' +
'      <Verticalized>False</Verticalized>' +
'      <StyledText>' +
'        <Element>' +
'          <String>Pré-couche Anti-UV Avant....</String>' +
'          <Attributes>' +
'            <Font Family="Helvetica Neue" Size="16" Bold="True" Italic="False" Underline="False" Strikeout="False"/>' +
'            <ForeColor Alpha="255" Red="0" Green="0" Blue="0"/>' +
'          </Attributes>' +
'        </Element>' +
'        <Element>' +
'          <String>' +
'</String>' +
'          <Attributes>' +
'            <Font Family="Helvetica Neue" Size="16" Bold="True" Italic="False" Underline="False" Strikeout="False"/>' +
'            <ForeColor Alpha="255" Red="0" Green="0" Blue="0"/>' +
'          </Attributes>' +
'        </Element>' +
'        <Element>' +
'          <String>Huilage pour Douglas Woca</String>' +
'          <Attributes>' +
'            <Font Family="Helvetica Neue" Size="16" Bold="True" Italic="False" Underline="False" Strikeout="False"/>' +
'            <ForeColor Alpha="255" Red="0" Green="0" Blue="0"/>' +
'          </Attributes>' +
'        </Element>' +
'      </StyledText>' +
'    </TextObject>' +
'    <Bounds X="331.2" Y="163" Width="2632.079" Height="1217.682"/>' +
'  </ObjectInfo>' +
'</DieCutLabel>';