Add-Type -AssemblyName System.Drawing

$src = [System.Drawing.Bitmap]::FromFile("c:\Users\alexandra\Documents\EDUCACION FINANCIERA\img\reference.png")
$imgDir = "c:\Users\alexandra\Documents\EDUCACION FINANCIERA\img"

# Hero illustration with no artifacts on left or top:
$heroRect = New-Object System.Drawing.Rectangle(308, 56, 356, 218)
$heroCrop = $src.Clone($heroRect, $src.PixelFormat)
$heroCrop.Save("$imgDir\hero-illustration.png", [System.Drawing.Imaging.ImageFormat]::Png)
$heroCrop.Dispose()

# Also let's save the left decorative swoosh
# In the original design, left is from X: 15 to 65
$waveRect = New-Object System.Drawing.Rectangle(15, 45, 45, 290)
$waveCrop = $src.Clone($waveRect, $src.PixelFormat)
$waveCrop.Save("$imgDir\wave-hero.png", [System.Drawing.Imaging.ImageFormat]::Png)
$waveCrop.Dispose()

# Footer wave:
$footerWaveRect = New-Object System.Drawing.Rectangle(15, 575, 45, 85)
$footerWaveCrop = $src.Clone($footerWaveRect, $src.PixelFormat)
$footerWaveCrop.Save("$imgDir\wave-footer.png", [System.Drawing.Imaging.ImageFormat]::Png)
$footerWaveCrop.Dispose()

$src.Dispose()
Write-Host "Updated illustration clean!"
