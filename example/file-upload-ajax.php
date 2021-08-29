<?php

require_once __DIR__ . '/ImPro/image-processor.php';

if (isset($_POST['validator'])) {
    if (isset($_POST['image'])) {
        if (!empty($_POST['image'])) {
            $impro = new \ImPro\Image\placer(__DIR__ . '/storage/');
            $result = $impro->base64($_POST['image']);
            if ($result['status']['success']) {
                $hasil = [
                    'success' => true,
                    'reason' => $result['reason']
                ];
                echo json_encode($hasil);
                die();
            } else {
                $hasil = [
                    'success' => false,
                    'reason' => $result['reason']
                ];
                echo json_encode($hasil);
                die();
            }
        } else {
            $hasil = [
                'success' => false,
                'reason' => 'tidak ada gambar'
            ];
            echo json_encode($hasil);
            die();
        }
    } else {
        $hasil = [
            'success' => false,
            'reason' => 'tidak valid'
        ];
        echo json_encode($hasil);
        die();
    }
}

?>
<html>

<head>
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- DROPIFY -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div id="dropify-input">
            <input type="file" class="dropify" data-allowed-file-extensions="png jpg jpeg" />
            <button class="btn btn-outline-primary sent">Kirim Gambar</button>
        </div>
    </div>
    <script>
        $(document).on('click', '.sent', function() {
            var image = $('#dropify-input img').attr('src');
            $.ajax({
                url: ".",
                method: "POST",
                async: true,
                data: {
                    validator: true,
                    image: image
                },
                failed: function() {
                    alert('failed');
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.success === true) {
                        alert('file uploaded');
                    } else {
                        alert(data.reason);
                    }
                }
            })
        });
    </script>
</body>

</html>
