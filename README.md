# ImPro (Image Processor)
intinya sih mempermudah pengolahan gambar<br>
<hr>

daftar menu :

* Penggunaan
    * [Manipulator](#image-manipulator-usage)
    * [Placer](#image-placement-usage)
    
* [Installasi](#cara-installasi)

* [Tutorial Placer](#menggunakan-imageplacer)
    * [post()](#implacer-post)
    * [base64()](#implacer-base64)
    * [Hasil](#implacer-result)
 
* [Tutorial Manipulator](#menggunakan-image-processor)
    * Resize/Quality
  	 * Watermark/Quality

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
    $file_extention,    /* string/false/bool -1 */
    $allowed_extention, /* array/false/bool -1 */
    $upload_limit,      /* float/false/bool -1 */
    $replace_file,      /* true/false/bool -1 */
):array;
```
| Syntax  | Penjelasan |
| ------------- | ------------- |
| `$input_name` | nama input yang didapat dari `name="nama_input_mu"` |
| `$filename` | nama file custom yang ingin ditulis, jika nama dari foto tersebut ingin di ganti namanya. |
| `$file_extention` | ekstensi file custom misal jika ingin semua file yang diupload adalah `png` maka ditulis `png` |
| `$allowed_extention` | jika `file_extension` bukan `false` syntax ini wajib `false`, jika ingin mengaktifkan fitur ini wajib untuk mengisi `$file_extention` menjadi `false` <br> `$allowed_extention` adalah `array()` contohnya `array('png','jpeg','jpg')`, berarti yang diperbolehkan hanya png/jpeg/jpg saja, selain itu akan return `success=false` |
| `$upload_limit` | limit ukuran file gambar tersebut, dihitung dalam `byte` |
| `$replace_file` | mengizinkan/tidak untuk me-replace file yang sudah ada, `true` jika mengizinkan replace. |

syntax dapat ditiadakan jika tidak memiliki lanjutan,<br>
contoh, aku hanya akan menggunakan input name saja, jadi:
```php
$result = $imPlacer->post('nama_input_mu'); /* sah */
```
namun jika ingin `menggunakan` | `tidak` | `menggunakan` , maka bagian yang `tidak` harus ditulis false,<br>
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
    $file_extention,    /* string/false/bool -1 */
    $upload_limit,      /* float/false/bool -1 */
    $replace_file,      /* true/false/bool -1 */
):array;
```

| Syntax  | Penjelasan |
| ------------- | ------------- |
| `$base64_data` | data image base64 dari manapun, GET/POST/SESSION |
| `$filename` | nama file custom yang ingin ditulis, jika nama dari foto tersebut ingin di ganti namanya. |
| `$file_extention` | ekstensi file custom misal jika ingin semua file yang diupload adalah `png` maka ditulis `png` |
| `$upload_limit` | limit ukuran file gambar tersebut, dihitung dalam `byte` |
| `$replace_file` | mengizinkan/tidak untuk me-replace file yang sudah ada, `true` jika mengizinkan replace. |


contoh, aku hanya akan menggunakan data base64 saja, jadi:
```php
$result = $imPlacer->base64($_POST['image_base64'); /* sah */
```
namun jika ingin `menggunakan` | `tidak` | `menggunakan` , maka bagian yang `tidak` harus ditulis false,<br>
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


