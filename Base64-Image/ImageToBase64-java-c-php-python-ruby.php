<?php
echo "PHP <br>";
echo $s = "
$path = 'folder/image.png';
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
";

echo "C# <br>";
echo $s = '
using (Image image = Image.FromFile(Path))
{
using (MemoryStream m = new MemoryStream())
{
image.Save(m, image.RawFormat);
byte[] imageBytes = m.ToArray();
// Convert byte[] to Base64 String
string base64String = Convert.ToBase64String(imageBytes);
return base64String;
}
}
';

echo "JAVA <br>";

echo $s ='
public static String encodeToString(BufferedImage image, String type) {
String base64String = null;
ByteArrayOutputStream bos = new ByteArrayOutputStream();
try {
ImageIO.write(image, type, bos);
byte[] imageBytes = bos.toByteArray();
BASE64Encoder encoder = new BASE64Encoder();
base64String = encoder.encode(imageBytes);
bos.close();
} catch (IOException e) {
e.printStackTrace();
}
return base64String;
}
';

echo "PYTHON <br>";

echo $s ='
import base64
imgdata = base64.b64decode(imgstring)
filename = "some_image.jpg"
with open(filename, "wb") as f:
f.write(imgdata)
';

echo "RUBY <br>";
echo $s = '
#!/usr/bin/env ruby
require 'base64'
File.open('imagetobase64.png', 'r') do|image_file|
puts Base64.encode64(image_file.read)
end
';
