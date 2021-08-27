# ImPro (Image Processor)
intinya sih mempermudah pengolahan gambar<br>
<hr>

daftar menu :

* Penggunaan
    * [Manipulator](#image-manipulator-usage)
    * Placer
 
* Tutorial Placer
    * post()
    * base64()
 
* Tutorial Manipulator
    * Resize/Quality
  	* Watermark/Quality

<hr>

### image manipulator usage

| Feature  | Penjelasan | Depedensi |
| ------------- | ------------- | ------------- |
| `\ImPro\Processor\compress()`  | mengkompress gambar dan me-resize gambar secara responsive | Imagick |
| `\ImPro\Processor\watermark()`  | menempelkan watermark kepada foto/gambar yang diinginkan | Imagick |

<hr>

### [image placement usage](#penggunaan_2)

```php
$impro = new \ImPro\Image\placer($working_dir)
```
| Feature  | Penjelasan | Depedensi |
| ------------- | ------------- | ------------- |
| `$impro->post()` | menaruh gambar secara langsung dari request form secara post | - |
| `$impro->base64()` | menaruh gambar secara langsung bisa melalui AJAX/FETCH/AXIOS dan lainnya | - |

<hr>

## [Cara Installasi](#installasi)

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

## [Menggunakan "Image\placer"](#tutorial_palcer)

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

### [imPlacer->post() ](#tutorial_placer_post)

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
