$ExcelObject = New-Object -COM Excel.Application;
$ExcelWorkBook = $ExcelObject.Workbooks.Add();
$ExcelWorkSheet = $ExcelWorkBook.Worksheets.Item(1);
$x = 2;
$y = 2;
$ExcelWorkSheet.Cells.Item($x,$y) = "Привет от PowerShell";
$ExcelWorkSheet.Cells.Item($x,$y).Font.size=12;
$ExcelWorkSheet.Cells.Item($x,$y).Font.Italic = $true;
$ExcelWorkBook.SaveAs("C:\Users\$env:UserName\Desktop\"+$env:UserName+"_"+$env:ComputerName+".xlsx");
$ExcelWorkBook.close($true);
