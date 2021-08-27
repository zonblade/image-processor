# ImPro (Image Processor)
intinya sih mempermudah pengolahan gambar<br>
follow [instagram @zonblade](https://instagram.com/zonblade) untuk mengetahui update codingan terbaruku.
<hr>

daftar isi :

* Penggunaan
    * [Manipulator](#image-manipulator-usage)
    * [Placer](#image-placement-usage)
    
* [Installasi](#cara-installasi)

* [Tutorial Placer](#menggunakan-imageplacer)
    * [post()](#implacer-post)
    * [base64()](#implacer-base64)
    * [Hasil](#implacer-result)
 
* [Tutorial Manipulator](#menggunakan-image-processor)
    * [Resize/Quality](#image-processing-compress)
  	 * [Watermark/Quality](#image-processing-watermark)
  	 * [Hasil](#image-processor-result)

<hr>

### image manipulator usage

| Feature  | Penjelasan | Depedensi |
| ------------- | ------------- | ------------- |
| `\ImPro\Processor\compress()`  | mengkompress gambar dan me-resize gambar secara responsive | Imagick |
| `\ImPro\Processor\watermark()`  | menempelkan watermark kepada foto/gambar yang diinginkan | Imagick |

<hr>

### image placement usage

```php
$impro = new \ImPro\Image\placer($working_dir)
```
| Feature  | Penjelasan | Depedensi |
| ------------- | ------------- | ------------- |
| `$impro->post()` | menaruh gambar secara langsung dari request form secara post | - |
| `$impro->base64()` | menaruh gambar secara langsung bisa melalui AJAX/FETCH/AXIOS dan lainnya | - |

<hr>

## Cara Installasi

kloning git ini, atau download manual.
```bash
cd /folder/project/mu
git clone https://github.com/zonblade/image-processor.git
```
setelah itu bisa di masukan ke Autoload kalian, maupun require langsung. Cara ini terserah kalian.<br>
cara 1 :
```php
require_once __DIR__.'/path/to/plugin/image-processor.php';
use \ImPro as impro;
```
cara 2 (menggunakan secara eksplisit) :
```php
require_once __DIR__.'/path/to/plugin/image-processor.php';
/* langsung dengan \ImPro */
```

docs ini akan menggunakan cara eksplisit (cara 2)

<hr>

## Menggunakan ImagePlacer

dasar-dasar yang harus diketahui

```php

require_once __DIR__.'/path/to/plugin/image-processor.php';
$working_dir = '/path/to/image/folder/';
$imPlacer = new \ImPro\Image\placer($working_dir);

```
| Syntax  | Penjelasan |
| ------------- | ------------- |
| `$working_dir` | direktori dimana gambar mu akan ditaruh |


<hr>

### imPlacer post

| usage  | Penjelasan |
| ------------- | ------------- |
| fetch input | hanya untuk form input |

lalu, untuk menaruh gambar dengan FORM dan method POST seperti dibawah ini
```html
<form action="." method="POST">
    <input type="file" name="nama_input_mu">
    <input type="submit" value="submit">
</form>
```
penjelasan kode php
```php
$result = $imPlacer->post(
    $input_name,        /* string/false/bool */
    $filename,          /* string/false/bool -1 */
    $file_extension,    /* string/false/bool -1 */
    $allowed_extension, /* array/false/bool -1 */
    $upload_limit,      /* float/false/bool -1 */
    $replace_file,      /* true/false/bool -1 */
);
```
| Syntax  | Penjelasan |
| ------------- | ------------- |
| `$input_name` | nama input yang didapat dari `name="nama_input_mu"` |
| `$filename` | nama file custom yang ingin ditulis, jika nama dari foto tersebut ingin di ganti namanya. |
| `$file_extension` | ekstensi file custom misal jika ingin semua file yang diupload adalah `png` maka ditulis `png` |
| `$allowed_extension` | jika `file_extension` bukan `false` syntax ini wajib `false`, jika ingin mengaktifkan fitur ini wajib untuk mengisi `$file_extension` menjadi `false` <br> `$allowed_extension` adalah `array()` contohnya `array('png','jpeg','jpg')`, berarti yang diperbolehkan hanya png/jpeg/jpg saja, selain itu akan return `success=false` |
| `$upload_limit` | limit ukuran file gambar tersebut, dihitung dalam `byte` |
| `$replace_file` | mengizinkan/tidak untuk me-replace file yang sudah ada, `true` jika mengizinkan replace. |

syntax dapat ditiadakan jika tidak memiliki lanjutan,<br>
contoh, aku hanya akan menggunakan input name saja, jadi:
```php
$result = $imPlacer->post('nama_input_mu'); /* sah */
```
namun jika ingin `menggunakan` | `tidak` | `menggunakan` , maka bagian yang `tidak` harus ditulis false,<br>
dan yang tidak dipakai dibelakangnya dapat diabaikan<br>
contoh, aku ingin menggunakan input name dan file extension, maka:
```php
$result = $imPlacer->post('nama_input_mu','png'); /* TIDAK sah */
$result = $imPlacer->post('nama_input_mu',false,'png'); /* sah */
```
berlaku juga untuk `menggunakan` | `tidak` | `tidak` | `menggunakan` maka bagian yang `tidak` harus ditulis false,<br>
contoh, aku ingin menggunakan input name dan allowed extension, maka:
```php
$allowed = ['png','jpg'];
$result = $imPlacer->post('nama_input_mu',$allowed); /* TIDAK sah */
$result = $imPlacer->post('nama_input_mu',false,false,$allowed); /* sah */
```

<hr>

### imPlacer base64

| usage  | Penjelasan |
| ------------- | ------------- |
| fetch any | penggunaan bebas GET/POST selama data berbentuk base64 |
   
dapat digunakan untuk `ajax` `axios` maupun `fetch`

penjelasan kode php
```php
$result = $imPlacer->base64(
    $base64_data,       /* string/wajib */
    $filename,          /* string/false/bool -1 */
    $file_extension,    /* string/false/bool -1 */
    $upload_limit,      /* float/false/bool -1 */
    $replace_file,      /* true/false/bool -1 */
);
```

| Syntax  | Penjelasan |
| ------------- | ------------- |
| `$base64_data` | data image base64 dari manapun, GET/POST/SESSION |
| `$filename` | nama file custom yang ingin ditulis, jika nama dari foto tersebut ingin di ganti namanya. |
| `$file_extension` | ekstensi file custom misal jika ingin semua file yang diupload adalah `png` maka ditulis `png` |
| `$upload_limit` | limit ukuran file gambar tersebut, dihitung dalam `byte` |
| `$replace_file` | mengizinkan/tidak untuk me-replace file yang sudah ada, `true` jika mengizinkan replace. |


contoh, aku hanya akan menggunakan data base64 saja, jadi:
```php
$result = $imPlacer->base64($_POST['image_base64'); /* sah */
```
namun jika ingin `menggunakan` | `tidak` | `menggunakan` , maka bagian yang `tidak` harus ditulis false,<br>
dan yang tidak dipakai dibelakangnya dapat diabaikan<br>
contoh, aku ingin menggunakan data base64 dan file extension, maka:
```php
$result = $imPlacer->base64($_POST['image_base64','png'); /* TIDAK sah */
$result = $imPlacer->base64($_POST['image_base64',false,'png'); /* sah */
```
berlaku juga untuk `menggunakan` | `tidak` | `tidak` | `menggunakan` maka bagian yang `tidak` harus ditulis false,<br>
contoh, aku ingin menggunakan data base64 dan upload limit, maka:
```php
$result = $imPlacer->base64($_POST['image_base64',$allowed); /* TIDAK sah */
$result = $imPlacer->base64($_POST['image_base64',false,false,240000); /* sah */
```

### imPlacer result

untuk result yang dihasilkan
```php
//contoh
$result['status']['success'] // return true/false
```
| Result  | Penjelasan | Condition |
| ------------- | ------------- |------------- |
| `['status']['success']` | menghasilkan `true/false` | `param` |
| `['image']['name']` | output berupa filename dan ekstensi dari foto yang sudah diupload | need `['success']==true` |
| `['image']['path']` | output system path ke file tersebut. | need `['success']==true` |
| `['reason']` | memunculkan alasan jika terjadi error atau sejenisnya | both `['success']==true/false` |


<hr>

## Menggunakan Image Processor

Image processor menggunakan [imagick](https://www.php.net/manual/en/book.imagick.php) <br>
jadi untuk pengguna VPS harap menginstall imagicknya dulu, dan pengguna cPanel harap mengaktifkan fitur imagick.<br>
[tutorial install imagick di vps (ubuntu)](https://ourcodeworld.com/articles/read/645/how-to-install-imagick-for-php-7-in-ubuntu-16-04) <br>
[tutorial install imagick di vps (windows)](https://herbmiller.me/installing-imagick-php-7/) <br>
[aktivasi imagick di cpanel](https://www.youtube.com/watch?v=yfxIquNhG8k&pp=ugMICgJpZBABGAE%3D)<br>
[aktivasi imagick di whm](https://www.youtube.com/watch?v=9Wzd-aob2kA)
<br>
jika tidak ingin menggunakan ImageProcessor tidak apa apa untuk tidak menginstall imagick, tidak akan terjadi error.

### dasar dasar
untuk cara include/require tetap sama, hanya saja tidak memerlukan working dir. 

```php

require_once __DIR__.'/path/to/plugin/image-processor.php';

```

penggunaan Image Processor biasanya digunakan setelah melalui proses upload, jadi kira kira seperti ini

`upload gambar`=>`berhasil`=>`diprosess imagick`=>`gambar hasil resize/quality`

jadi tidak ada prosess upload disini, image processor ini hanya pemanis untuk upload. <br> `kedepannya akan ditambah fitur-fitur imagick lainnya`

<br>
list cheatseet, akan dibutuhkan nanti.

cheat seet $filter
```
POINT
BOX
TRIANGLE
HERMITE
HANNING
HAMMING
BLACKMAN
GAUSSIAN
QUADRATIC
CUBIC
CATROM
MITCHELL
BESSEL
SINC
LANCZOS
```
cheat seet $compression
```
JPEG
UNDEFINED
NO
BZIP
FAX
GROUP4
JPEG2000
LOSSLESSJPEG
LZW
RLE
ZIP
DXT1
DXT3
DXT5
ZIPS
PIZ
PXR24
B44
B44A
LZMA
JBIG1
JBIG2
 ```

<br>

## Image Processing Compress

contoh kode.
```php
$result = \ImPro\Processor\compress(
    $file_path,      /* path/false/bool */
    $image_size,     /* int/false/bool -1 */
    $quality,        /* int/false/bool -1 */
    $filter,         /* string/false/bool -1 */
    $compression,    /* string/false/bool -1 */
);
```

| Syntax  | Penjelasan |
| ------------- | ------------- |
| `$file_path` | path ke file gambar yang ingin di prosess |
| `$image_size` | fitur resize untuk skala max-width/max-height secara responsive |
| `$quality` | 100 untuk kualitas tertinggi dan 1 untuk terendah |
| `$filter` | tipe filter imagick, dapat diabaikan |
| `$compression` | tipe kompresi imagick, dapat diabaikan |

contoh jika ingin `menggunakan` | `tidak` | `menggunakan` , maka bagian yang `tidak` harus ditulis false,<br>
dan yang tidak dipakai dibelakangnya dapat diabaikan<br>
contoh, aku ingin menggunakan quality saja, maka:
```php
$result = \ImPro\Processor\compress('/path/to/image.png',100); /* sah namun akan mempengaruhi image_size dan bukan quality */
$result = \ImPro\Processor\compress('/path/to/image.png',false,85); /* sah, mempengaruhi quality */
```

<br>

## Image Processing Watermark

contoh kode.
```php
$result = \ImPro\Processor\watermark(
    $img_path,           /* path/false/bool */
    $watermark_path,     /* path/false */
    $img_quality,        /* int/false */
    $filter,             /* string/false */
);
```

| Syntax  | Penjelasan |
| ------------- | ------------- |
| `$img_path` | path ke file gambar yang ingin di prosess |
| `$watermark_path` | path ke file watermark, disarankan transparency/png |
| `$img_quality` | 100 untuk kualitas tertinggi dan 1 untuk terendah |
| `$filter` | tipe filter imagick, dapat ditulis `false` |

semua wajib diisi dan yang tidak dipakai dibelakangnya TIDAK dapat diabaikan<br>

```php
$result = \ImPro\Processor\compress('/path/to/image.png','/path/to/watermark.png',100,'LANCZOS');
```

### Image Processor result

untuk result yang dihasilkan
```php
//contoh
$result['status']['success'] // return true/false
```
| Result  | Penjelasan | Condition |
| ------------- | ------------- |------------- |
| `['status']['success']` | menghasilkan `true/false` | `param` |
| `['reason']` | memunculkan alasan jika terjadi error atau suksess | both `['success']==true/false` |
