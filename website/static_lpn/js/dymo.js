function test() {
  var labelSetBuilder = new dymo.label.framework.LabelSetBuilder();

  var printers = dymo.label.framework.getPrinters();

  for (var i = 0; i < printers.length; i++)
  {
      var printer = printers[i];

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

var label;

function updatePreview()
{
    if (!label)
        return;

    var pngData = label.render();

    var labelImage = $('#labelImage');
    if(labelImage)
      labelImage.attr("src","data:image/png;base64," + pngData);
}

function printLabel(print) {
  var printerName = "DYMO LabelWriter 4XL";
  var selectedprinter;
  var printers = dymo.label.framework.getPrinters();
  for (var i = 0; i < printers.length; i++)
  {
      var printer = printers[i];
      console.log(printer.name);
      if(printer.name==printerName)
          selectedPrinter=printer;

  }

  label = dymo.label.framework.openLabelXml(labelXml);



    if(typeof(productName) !='undefined') {
      label.setObjectText("Nom",productName);
      label.setObjectText("Description",productDescription);
      label.setObjectText("TEXTE",productChars);
    }

    updatePreview();


    

     try
    {
      if(print)
        label.print(printerName);
      //alert(labelSet.toString());
    }
    catch (e)
    {
        alert(e.message || e);
    }


}



jQuery(document).ready(function() {
  //test();
  printLabel(false);
  ( "#target" )
  $('#labelImage').click(function() {
printLabel(true);
});
});

var labelXml2 = ''+
 '<DieCutLabel Version="8.0" Units="twips">'+
 '<PaperOrientation>Landscape</PaperOrientation>'+
 '<Id>Address</Id>'+
 '<PaperName>30252 Address</PaperName>'+
 '<DrawCommands/>'+
 '<ObjectInfo>'+
 '<TextObject>'+
 '<Name>Text</Name>'+
 '<ForeColor Alpha="255" Red="0" Green="0" Blue="0" />'+
 '<BackColor Alpha="0" Red="255" Green="255" Blue="255" />'+
 '<LinkedObjectName></LinkedObjectName>'+
 '<Rotation>Rotation0</Rotation>'+
 '<IsMirrored>False</IsMirrored>'+
 '<IsVariable>True</IsVariable>'+
 '<HorizontalAlignment>Left</HorizontalAlignment>'+
 '<VerticalAlignment>Middle</VerticalAlignment>'+
 '<TextFitMode>ShrinkToFit</TextFitMode>'+
 '<UseFullFontHeight>True</UseFullFontHeight>'+
 '<Verticalized>False</Verticalized>'+
 '<StyledText/>'+
 '</TextObject>'+
 '<Bounds X="332" Y="150" Width="4455" Height="1260" />'+
 '</ObjectInfo>'+
 '</DieCutLabel>';

var labelXml = ''+
//'<?xml version="1.0" encoding="utf-8"?> ' +
'<DieCutLabel Version="8.0" Units="twips"> ' +
'  <PaperOrientation>Portrait</PaperOrientation> ' +
'  <Id>Shipping4x6</Id> ' +
'  <PaperName>1744907 4 in x 6 in</PaperName> ' +
'  <DrawCommands> ' +
'    <RoundRectangle X="0" Y="0" Width="5918.4" Height="9038.4" Rx="270" Ry="270"/>' +
'  </DrawCommands>' +
'  <ObjectInfo>' +
'    <ImageObject>' +
'      <Name>Image</Name>' +
'      <ForeColor Alpha="255" Red="0" Green="0" Blue="0"/>' +
'      <BackColor Alpha="0" Red="255" Green="255" Blue="255"/>' +
'      <LinkedObjectName></LinkedObjectName>' +
'      <Rotation>Rotation0</Rotation>' +
'      <IsMirrored>False</IsMirrored>' +
'      <IsVariable>False</IsVariable>' +
'      <Image>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</Image>' +
'      <ScaleMode>Uniform</ScaleMode>' +
'      <BorderWidth>0</BorderWidth>' +
'      <BorderColor Alpha="255" Red="0" Green="0" Blue="0"/>' +
'      <HorizontalAlignment>Center</HorizontalAlignment>' +
'      <VerticalAlignment>Center</VerticalAlignment>' +
'    </ImageObject>' +
'    <Bounds X="388.0844" Y="317.52" Width="5079.609" Height="960"/>' +
'  </ObjectInfo>' +
'  <ObjectInfo>' +
'    <ShapeObject>' +
'      <Name>Forme</Name>' +
'      <ForeColor Alpha="255" Red="0" Green="0" Blue="0"/>' +
'      <BackColor Alpha="0" Red="255" Green="255" Blue="255"/>' +
'      <LinkedObjectName></LinkedObjectName>' +
'      <Rotation>Rotation0</Rotation>' +
'      <IsMirrored>False</IsMirrored>' +
'      <IsVariable>False</IsVariable>' +
'      <ShapeType>HorizontalLine</ShapeType>' +
'      <LineWidth>45</LineWidth>' +
'      <LineAlignment>Center</LineAlignment>' +
'      <FillColor Alpha="0" Red="255" Green="255" Blue="255"/>' +
'    </ShapeObject>' +
'    <Bounds X="315" Y="1336.416" Width="5220" Height="45"/>' +
'  </ObjectInfo>' +
'  <ObjectInfo>' +
'    <AddressObject>' +
'      <Name>Description</Name>' +
'      <ForeColor Alpha="255" Red="0" Green="0" Blue="0"/>' +
'      <BackColor Alpha="0" Red="255" Green="255" Blue="255"/>' +
'      <LinkedObjectName></LinkedObjectName>' +
'      <Rotation>Rotation0</Rotation>' +
'      <IsMirrored>False</IsMirrored>' +
'      <IsVariable>True</IsVariable>' +
'      <HorizontalAlignment>Left</HorizontalAlignment>' +
'      <VerticalAlignment>Top</VerticalAlignment>' +
'      <TextFitMode>None</TextFitMode>' +
'      <UseFullFontHeight>True</UseFullFontHeight>' +
'      <Verticalized>False</Verticalized>' +
'      <StyledText>' +
'        <Element>' +
'          <String>XXXXXX</String>' +
'          <Attributes>' +
'            <Font Family="Arial" Size="9" Bold="False" Italic="False" Underline="False" Strikeout="False"/>' +
'            <ForeColor Alpha="255" Red="0" Green="0" Blue="0"/>' +
'          </Attributes>' +
'        </Element>' +
'      </StyledText>' +
'      <ShowBarcodeFor9DigitZipOnly>False</ShowBarcodeFor9DigitZipOnly>' +
'      <BarcodePosition>Suppress</BarcodePosition>' +
'      <LineFonts/>' +
'    </AddressObject>' +
'    <Bounds X="330" Y="2401.366" Width="5220" Height="3225.844"/>' +
'  </ObjectInfo>' +
'  <ObjectInfo>' +
'    <ShapeObject>' +
'      <Name>Forme 1</Name>' +
'      <ForeColor Alpha="255" Red="0" Green="0" Blue="0"/>' +
'      <BackColor Alpha="0" Red="255" Green="255" Blue="255"/>' +
'      <LinkedObjectName></LinkedObjectName>' +
'      <Rotation>Rotation0</Rotation>' +
'      <IsMirrored>False</IsMirrored>' +
'      <IsVariable>False</IsVariable>' +
'      <ShapeType>HorizontalLine</ShapeType>' +
'      <LineWidth>15</LineWidth>' +
'      <LineAlignment>Center</LineAlignment>' +
'      <FillColor Alpha="0" Red="255" Green="255" Blue="255"/>' +
'    </ShapeObject>' +
'    <Bounds X="330" Y="2268" Width="5220" Height="17.01"/>' +
'  </ObjectInfo>' +
'  <ObjectInfo>' +
'    <ShapeObject>' +
'      <Name>Forme 2</Name>' +
'      <ForeColor Alpha="255" Red="0" Green="0" Blue="0"/>' +
'      <BackColor Alpha="0" Red="255" Green="255" Blue="255"/>' +
'      <LinkedObjectName></LinkedObjectName>' +
'      <Rotation>Rotation0</Rotation>' +
'      <IsMirrored>False</IsMirrored>' +
'      <IsVariable>False</IsVariable>' +
'      <ShapeType>HorizontalLine</ShapeType>' +
'      <LineWidth>15</LineWidth>' +
'      <LineAlignment>Center</LineAlignment>' +
'      <FillColor Alpha="0" Red="255" Green="255" Blue="255"/>' +
'    </ShapeObject>' +
'    <Bounds X="370.7812" Y="5795.937" Width="5220" Height="15"/>' +
'  </ObjectInfo>' +
'  <ObjectInfo>' +
'    <TextObject>' +
'      <Name>TEXTE</Name>' +
'      <ForeColor Alpha="255" Red="0" Green="0" Blue="0"/>' +
'      <BackColor Alpha="0" Red="255" Green="255" Blue="255"/>' +
'      <LinkedObjectName></LinkedObjectName>' +
'      <Rotation>Rotation0</Rotation>' +
'      <IsMirrored>False</IsMirrored>' +
'      <IsVariable>False</IsVariable>' +
'      <HorizontalAlignment>Left</HorizontalAlignment>' +
'      <VerticalAlignment>Top</VerticalAlignment>' +
'      <TextFitMode>None</TextFitMode>' +
'      <UseFullFontHeight>True</UseFullFontHeight>' +
'      <Verticalized>False</Verticalized>' +
'      <StyledText>' +
'        <Element>' +
'          <String>Caractéristiques :' +
'</String>' +
'          <Attributes>' +
'            <Font Family="Arial" Size="9" Bold="False" Italic="False" Underline="False" Strikeout="False"/>' +
'            <ForeColor Alpha="255" Red="0" Green="0" Blue="0"/>' +
'          </Attributes>' +
'        </Element>' +
'        <Element>' +
'          <String>Dimensions: Ep: 21mm' +
'Finition: brut' +
'Profil: lisse,antiderapant' +
'Longueurs panachées :  80% en lames de 3m en lames aboutées, 800/1200/1500 en lames continues' +
'Conditionnement :  Bottes de 5 lames de 3 mètres, botte de 5 lames de 4m' +
'Essence: Acajou' +
'Choix: Courant' +
'Type de pose / Fixation: invisible</String>' +
'          <Attributes>' +
'            <Font Family="Arial" Size="9" Bold="False" Italic="False" Underline="False" Strikeout="False"/>' +
'            <ForeColor Alpha="255" Red="0" Green="0" Blue="0"/>' +
'          </Attributes>' +
'        </Element>' +
'      </StyledText>' +
'    </TextObject>' +
'    <Bounds X="330" Y="5893.301" Width="5220" Height="2254.226"/>' +
'  </ObjectInfo>' +
'  <ObjectInfo>' +
'    <AddressObject>' +
'      <Name>Nom</Name>' +
'      <ForeColor Alpha="255" Red="0" Green="0" Blue="0"/>' +
'      <BackColor Alpha="0" Red="255" Green="255" Blue="255"/>' +
'      <LinkedObjectName></LinkedObjectName>' +
'      <Rotation>Rotation0</Rotation>' +
'      <IsMirrored>False</IsMirrored>' +
'      <IsVariable>True</IsVariable>' +
'      <HorizontalAlignment>Left</HorizontalAlignment>' +
'      <VerticalAlignment>Middle</VerticalAlignment>' +
'      <TextFitMode>None</TextFitMode>' +
'      <UseFullFontHeight>True</UseFullFontHeight>' +
'      <Verticalized>False</Verticalized>' +
'      <StyledText>' +
'        <Element>' +
'          <String>Acacia Choix Courant Fixation à  Visser 1 Face Lisse / 1 Face Antidérapante Profil Peigné</String>' +
'          <Attributes>' +
'            <Font Family="DINPro" Size="9" Bold="True" Italic="False" Underline="False" Strikeout="False"/>' +
'            <ForeColor Alpha="255" Red="0" Green="0" Blue="0"/>' +
'          </Attributes>' +
'        </Element>' +
'      </StyledText>' +
'      <ShowBarcodeFor9DigitZipOnly>False</ShowBarcodeFor9DigitZipOnly>' +
'      <BarcodePosition>Suppress</BarcodePosition>' +
'      <LineFonts/>' +
'    </AddressObject>' +
'    <Bounds X="330" Y="1600.401" Width="5220" Height="422"/>' +
'  </ObjectInfo>' +
'  <ObjectInfo>' +
'    <TextObject>' +
'      <Name>TEXTE_2</Name>' +
'      <ForeColor Alpha="255" Red="0" Green="0" Blue="0"/>' +
'      <BackColor Alpha="0" Red="255" Green="255" Blue="255"/>' +
'      <LinkedObjectName></LinkedObjectName>' +
'      <Rotation>Rotation0</Rotation>' +
'      <IsMirrored>False</IsMirrored>' +
'      <IsVariable>False</IsVariable>' +
'      <HorizontalAlignment>Left</HorizontalAlignment>' +
'      <VerticalAlignment>Middle</VerticalAlignment>' +
'      <TextFitMode>None</TextFitMode>' +
'      <UseFullFontHeight>True</UseFullFontHeight>' +
'      <Verticalized>False</Verticalized>' +
'      <StyledText>' +
'        <Element>' +
'          <String>TMACAFACOU00BS</String>' +
'          <Attributes>' +
'            <Font Family="Arial" Size="7" Bold="False" Italic="False" Underline="False" Strikeout="False"/>' +
'            <ForeColor Alpha="255" Red="0" Green="0" Blue="0"/>' +
'          </Attributes>' +
'        </Element>' +
'      </StyledText>' +
'    </TextObject>' +
'    <Bounds X="330" Y="8438.828" Width="1903.791" Height="227.4219"/>' +
'  </ObjectInfo>' +
'  <ObjectInfo>' +
'    <BarcodeObject>' +
'      <Name>CODE-BARRES</Name>' +
'      <ForeColor Alpha="255" Red="0" Green="0" Blue="0"/>' +
'      <BackColor Alpha="255" Red="255" Green="255" Blue="255"/>' +
'      <LinkedObjectName>TEXTE_2</LinkedObjectName>' +
'      <Rotation>Rotation0</Rotation>' +
'      <IsMirrored>False</IsMirrored>' +
'      <IsVariable>True</IsVariable>' +
'      <Text>TMACAFACOU00BS</Text>' +
'      <Type>Code128Ean</Type>' +
'      <Size>Small</Size>' +
'      <TextPosition>Bottom</TextPosition>' +
'      <TextFont Family="Arial" Size="9" Bold="False" Italic="False" Underline="False" Strikeout="False"/>' +
'      <CheckSumFont Family="Lucida Grande" Size="10" Bold="False" Italic="False" Underline="False" Strikeout="False"/>' +
'      <TextEmbedding>None</TextEmbedding>' +
'      <ECLevel>0</ECLevel>' +
'      <HorizontalAlignment>Center</HorizontalAlignment>' +
'      <QuietZonesPadding Left="0" Right="0" Top="0" Bottom="0"/>' +
'    </BarcodeObject>' +
'    <Bounds X="2255.618" Y="8356.801" Width="3585.982" Height="600"/>' +
'  </ObjectInfo>' +
'</DieCutLabel>';


var labelXml3 = ''+
//'<?xml version="1.0" encoding="utf-8"?> ' +
'<DieCutLabel Version="8.0" Units="twips"> ' +
'  <PaperOrientation>Portrait</PaperOrientation> ' +
'  <Id>Shipping4x6</Id> ' +
'  <PaperName>1744907 4 in x 6 in</PaperName> ' +
'  <DrawCommands> ' +
'    <RoundRectangle X="0" Y="0" Width="5918.4" Height="9038.4" Rx="270" Ry="270"/>' +
'  </DrawCommands>' +
'  <ObjectInfo>' +
'    <ImageObject>' +
'      <Name>Image</Name>' +
'      <ForeColor Alpha="255" Red="0" Green="0" Blue="0"/>' +
'      <BackColor Alpha="0" Red="255" Green="255" Blue="255"/>' +
'      <LinkedObjectName></LinkedObjectName>' +
'      <Rotation>Rotation0</Rotation>' +
'      <IsMirrored>False</IsMirrored>' +
'      <IsVariable>False</IsVariable>' +
'      <ScaleMode>Uniform</ScaleMode>' +
'      <BorderWidth>0</BorderWidth>' +
'      <BorderColor Alpha="255" Red="0" Green="0" Blue="0"/>' +
'      <HorizontalAlignment>Center</HorizontalAlignment>' +
'      <VerticalAlignment>Center</VerticalAlignment>' +
'    </ImageObject>' +
'    <Bounds X="388.0844" Y="317.52" Width="5079.609" Height="960"/>' +
'  </ObjectInfo>' +
'  <ObjectInfo>' +
'    <ShapeObject>' +
'      <Name>Forme</Name>' +
'      <ForeColor Alpha="255" Red="0" Green="0" Blue="0"/>' +
'      <BackColor Alpha="0" Red="255" Green="255" Blue="255"/>' +
'      <LinkedObjectName></LinkedObjectName>' +
'      <Rotation>Rotation0</Rotation>' +
'      <IsMirrored>False</IsMirrored>' +
'      <IsVariable>False</IsVariable>' +
'      <ShapeType>HorizontalLine</ShapeType>' +
'      <LineWidth>45</LineWidth>' +
'      <LineAlignment>Center</LineAlignment>' +
'      <FillColor Alpha="0" Red="255" Green="255" Blue="255"/>' +
'    </ShapeObject>' +
'    <Bounds X="315" Y="1336.416" Width="5220" Height="45"/>' +
'  </ObjectInfo>' +
'  <ObjectInfo>' +
'    <AddressObject>' +
'      <Name>Description</Name>' +
'      <ForeColor Alpha="255" Red="0" Green="0" Blue="0"/>' +
'      <BackColor Alpha="0" Red="255" Green="255" Blue="255"/>' +
'      <LinkedObjectName></LinkedObjectName>' +
'      <Rotation>Rotation0</Rotation>' +
'      <IsMirrored>False</IsMirrored>' +
'      <IsVariable>True</IsVariable>' +
'      <HorizontalAlignment>Left</HorizontalAlignment>' +
'      <VerticalAlignment>Top</VerticalAlignment>' +
'      <TextFitMode>None</TextFitMode>' +
'      <UseFullFontHeight>True</UseFullFontHeight>' +
'      <Verticalized>False</Verticalized>' +
'      <StyledText>' +
'        <Element>' +
'          <String>XXXXXX</String>' +
'          <Attributes>' +
'            <Font Family="Arial" Size="9" Bold="False" Italic="False" Underline="False" Strikeout="False"/>' +
'            <ForeColor Alpha="255" Red="0" Green="0" Blue="0"/>' +
'          </Attributes>' +
'        </Element>' +
'      </StyledText>' +
'      <ShowBarcodeFor9DigitZipOnly>False</ShowBarcodeFor9DigitZipOnly>' +
'      <BarcodePosition>Suppress</BarcodePosition>' +
'      <LineFonts/>' +
'    </AddressObject>' +
'    <Bounds X="330" Y="2401.366" Width="5220" Height="3225.844"/>' +
'  </ObjectInfo>' +
'  <ObjectInfo>' +
'    <ShapeObject>' +
'      <Name>Forme 1</Name>' +
'      <ForeColor Alpha="255" Red="0" Green="0" Blue="0"/>' +
'      <BackColor Alpha="0" Red="255" Green="255" Blue="255"/>' +
'      <LinkedObjectName></LinkedObjectName>' +
'      <Rotation>Rotation0</Rotation>' +
'      <IsMirrored>False</IsMirrored>' +
'      <IsVariable>False</IsVariable>' +
'      <ShapeType>HorizontalLine</ShapeType>' +
'      <LineWidth>15</LineWidth>' +
'      <LineAlignment>Center</LineAlignment>' +
'      <FillColor Alpha="0" Red="255" Green="255" Blue="255"/>' +
'    </ShapeObject>' +
'    <Bounds X="330" Y="2268" Width="5220" Height="17.01"/>' +
'  </ObjectInfo>' +
'  <ObjectInfo>' +
'    <ShapeObject>' +
'      <Name>Forme 2</Name>' +
'      <ForeColor Alpha="255" Red="0" Green="0" Blue="0"/>' +
'      <BackColor Alpha="0" Red="255" Green="255" Blue="255"/>' +
'      <LinkedObjectName></LinkedObjectName>' +
'      <Rotation>Rotation0</Rotation>' +
'      <IsMirrored>False</IsMirrored>' +
'      <IsVariable>False</IsVariable>' +
'      <ShapeType>HorizontalLine</ShapeType>' +
'      <LineWidth>15</LineWidth>' +
'      <LineAlignment>Center</LineAlignment>' +
'      <FillColor Alpha="0" Red="255" Green="255" Blue="255"/>' +
'    </ShapeObject>' +
'    <Bounds X="370.7812" Y="5795.937" Width="5220" Height="15"/>' +
'  </ObjectInfo>' +
'  <ObjectInfo>' +
'    <TextObject>' +
'      <Name>TEXTE</Name>' +
'      <ForeColor Alpha="255" Red="0" Green="0" Blue="0"/>' +
'      <BackColor Alpha="0" Red="255" Green="255" Blue="255"/>' +
'      <LinkedObjectName></LinkedObjectName>' +
'      <Rotation>Rotation0</Rotation>' +
'      <IsMirrored>False</IsMirrored>' +
'      <IsVariable>False</IsVariable>' +
'      <HorizontalAlignment>Left</HorizontalAlignment>' +
'      <VerticalAlignment>Top</VerticalAlignment>' +
'      <TextFitMode>None</TextFitMode>' +
'      <UseFullFontHeight>True</UseFullFontHeight>' +
'      <Verticalized>False</Verticalized>' +
'      <StyledText>' +
'        <Element>' +
'          <String>Caractéristiques :' +
'</String>' +
'          <Attributes>' +
'            <Font Family="Arial" Size="9" Bold="True" Italic="False" Underline="False" Strikeout="False"/>' +
'            <ForeColor Alpha="255" Red="0" Green="0" Blue="0"/>' +
'          </Attributes>' +
'        </Element>' +
'        <Element>' +
'          <String>Dimensions: Ep: 21mm' +
'Finition: brut' +
'Profil: lisse,antiderapant' +
'Longueurs panachées :  80% en lames de 3m en lames aboutées, 800/1200/1500 en lames continues' +
'Conditionnement :  Bottes de 5 lames de 3 mètres, botte de 5 lames de 4m' +
'Essence: Acajou' +
'Choix: Courant' +
'Type de pose / Fixation: invisible</String>' +
'          <Attributes>' +
'            <Font Family="Arial" Size="9" Bold="False" Italic="False" Underline="False" Strikeout="False"/>' +
'            <ForeColor Alpha="255" Red="0" Green="0" Blue="0"/>' +
'          </Attributes>' +
'        </Element>' +
'      </StyledText>' +
'    </TextObject>' +
'    <Bounds X="330" Y="5893.301" Width="5220" Height="2054.226"/>' +
'  </ObjectInfo>' +
'  <ObjectInfo>' +
'    <AddressObject>' +
'      <Name>Nom</Name>' +
'      <ForeColor Alpha="255" Red="0" Green="0" Blue="0"/>' +
'      <BackColor Alpha="0" Red="255" Green="255" Blue="255"/>' +
'      <LinkedObjectName></LinkedObjectName>' +
'      <Rotation>Rotation0</Rotation>' +
'      <IsMirrored>False</IsMirrored>' +
'      <IsVariable>True</IsVariable>' +
'      <HorizontalAlignment>Left</HorizontalAlignment>' +
'      <VerticalAlignment>Top</VerticalAlignment>' +
'      <TextFitMode>None</TextFitMode>' +
'      <UseFullFontHeight>True</UseFullFontHeight>' +
'      <Verticalized>False</Verticalized>' +
'      <StyledText>' +
'        <Element>' +
'          <String>Acacia Choix Courant Fixation à  Visser 1 Face Lisse / 1 Face Antidérapante Profil Peigné</String>' +
'          <Attributes>' +
'            <Font Family="DINPro" Size="9" Bold="True" Italic="False" Underline="False" Strikeout="False"/>' +
'            <ForeColor Alpha="255" Red="0" Green="0" Blue="0"/>' +
'          </Attributes>' +
'        </Element>' +
'      </StyledText>' +
'      <ShowBarcodeFor9DigitZipOnly>False</ShowBarcodeFor9DigitZipOnly>' +
'      <BarcodePosition>Suppress</BarcodePosition>' +
'      <LineFonts/>' +
'    </AddressObject>' +
'    <Bounds X="330" Y="1673.401" Width="5220" Height="332"/>' +
'  </ObjectInfo>' +
'  <ObjectInfo>' +
'    <TextObject>' +
'      <Name>TEXTE_2</Name>' +
'      <ForeColor Alpha="255" Red="0" Green="0" Blue="0"/>' +
'      <BackColor Alpha="0" Red="255" Green="255" Blue="255"/>' +
'      <LinkedObjectName></LinkedObjectName>' +
'      <Rotation>Rotation0</Rotation>' +
'      <IsMirrored>False</IsMirrored>' +
'      <IsVariable>False</IsVariable>' +
'      <HorizontalAlignment>Left</HorizontalAlignment>' +
'      <VerticalAlignment>Middle</VerticalAlignment>' +
'      <TextFitMode>None</TextFitMode>' +
'      <UseFullFontHeight>True</UseFullFontHeight>' +
'      <Verticalized>False</Verticalized>' +
'      <StyledText>' +
'        <Element>' +
'          <String>TMACAFACOU00BS</String>' +
'          <Attributes>' +
'            <Font Family="Arial" Size="7" Bold="False" Italic="False" Underline="False" Strikeout="False"/>' +
'            <ForeColor Alpha="255" Red="0" Green="0" Blue="0"/>' +
'          </Attributes>' +
'        </Element>' +
'      </StyledText>' +
'    </TextObject>' +
'    <Bounds X="330" Y="8438.828" Width="1903.791" Height="227.4219"/>' +
'  </ObjectInfo>' +
'  <ObjectInfo>' +
'    <BarcodeObject>' +
'      <Name>CODE-BARRES</Name>' +
'      <ForeColor Alpha="255" Red="0" Green="0" Blue="0"/>' +
'      <BackColor Alpha="255" Red="255" Green="255" Blue="255"/>' +
'      <LinkedObjectName>TEXTE_2</LinkedObjectName>' +
'      <Rotation>Rotation0</Rotation>' +
'      <IsMirrored>False</IsMirrored>' +
'      <IsVariable>True</IsVariable>' +
'      <Text>TMACAFACOU00BS</Text>' +
'      <Type>Code128Ean</Type>' +
'      <Size>Small</Size>' +
'      <TextPosition>Bottom</TextPosition>' +
'      <TextFont Family="Arial" Size="9" Bold="False" Italic="False" Underline="False" Strikeout="False"/>' +
'      <CheckSumFont Family="Lucida Grande" Size="10" Bold="False" Italic="False" Underline="False" Strikeout="False"/>' +
'      <TextEmbedding>None</TextEmbedding>' +
'      <ECLevel>0</ECLevel>' +
'      <HorizontalAlignment>Center</HorizontalAlignment>' +
'      <QuietZonesPadding Left="0" Right="0" Top="0" Bottom="0"/>' +
'    </BarcodeObject>' +
'    <Bounds X="2255.618" Y="8356.801" Width="3585.982" Height="600"/>' +
'  </ObjectInfo>' +
'</DieCutLabel>';


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
'      <Name>Code-barres</Name>' +
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

