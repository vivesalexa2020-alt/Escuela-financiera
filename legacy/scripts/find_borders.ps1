Add-Type -AssemblyName System.Drawing

$src = [System.Drawing.Bitmap]::FromFile("c:\Users\alexandra\Documents\EDUCACION FINANCIERA\img\reference.png")

# Let's inspect columns from left to right along row 100 to find the left border
for ($x = 0; $x -lt 50; $x++) {
    $c = $src.GetPixel($x, 100)
    if ($c.G -gt 50 -and $c.R -lt 40) {
        Write-Host "Dark green starts at X = $x (R:$($c.R), G:$($c.G), B:$($c.B))"
        break
    }
}

# Let's check top border along column 200
for ($y = 0; $y -lt 30; $y++) {
    $c = $src.GetPixel(200, $y)
    if ($c.G -gt 40 -and $c.R -lt 30) {
        Write-Host "Dark green top starts at Y = $y"
        break
    }
}

# Let's check right border along row 100
for ($x = $src.Width - 1; $x -gt 600; $x--) {
    $c = $src.GetPixel($x, 100)
    if ($c.G -gt 40 -and $c.R -lt 30) {
        Write-Host "Dark green right ends at X = $x"
        break
    }
}

# Let's check bottom border along column 200
for ($y = $src.Height - 1; $y -gt 600; $y--) {
    $c = $src.GetPixel(200, $y)
    if ($c.G -gt 40 -and $c.R -lt 30) {
        Write-Host "Dark green bottom ends at Y = $y"
        break
    }
}

$src.Dispose()
