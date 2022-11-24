<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
    <style>
        .test {
            margin: 50px 0px 0px 50px;
        }

        .hasil {
            font-size: 20px;
            color: red;
            margin: 20px 0px 0px 50px;
        }
    </style>
</head>

<body>
    <div class="test">
        <form action="" method="post">
            <label for="text"> masukkan nomor dalam bentuk huruf </label>
            <br>
            <br>
            <input type="text" name="text" id="text" placeholder="text">

            <button type="submit" name="submit">Proses</button>
        </form>
    </div>
</body>

</html>

<?php
if (isset($_POST["submit"])) {
    $text = $_POST['text'];

    function wordsToNumber($data)
    {
        $data = strtr(
            $data,
            array(
                'zero'      => '0',
                'a'         => '1',
                'satu'       => '1',
                'dua'       => '2',
                'tiga'     => '3',
                'empat'      => '4',
                'lima'      => '5',
                'enam'       => '6',
                'tujuh'     => '7',
                'delapan'     => '8',
                'sembilan'      => '9',
                'sepuluh'       => '10',
                'sebelas'    => '11',
                'dua belas'    => '12',
                'tiga belas'  => '13',
                'empat belas'  => '14',
                'lima belas'   => '15',
                'enam belas'   => '16',
                'tujuh belas' => '17',
                'delapan belas'  => '18',
                'sembilan belas'  => '19',
                'dua puluh'    => '20',
                'tiga puluh'    => '30',
                'empat puluh'     => '40',
                'lima puluh'     => '50',
                'enam puluh'     => '60',
                'tujuh puluh'   => '70',
                'delapan puluh'    => '80',
                'sembilan puluh'    => '90',
                'seratus'   => '100',
                'seribu'  => '1000',
                'satujuta'   => '1000000',
                'satumillyar'   => '1000000000',
                'tambah'       => '+',
                'bagi' => '/',
            )
        );


        $parts = array_map(
            function ($val) {
                return floatval($val);
            },
            preg_split('/[\s-]+/', $data)
        );



        $stack = new SplStack;
        $sum   = '0';
        $last  = null;

        foreach ($parts as $part) {
            if (!$stack->isEmpty()) {
                if ($stack->top() > $part) {
                    if ($last >= 1000) {
                        $sum += $stack->pop();
                        $stack->push($part);
                    } else {
                        $stack->push($stack->pop() + $part);
                    }
                } else {
                    $stack->push($stack->pop() + $part);
                }
            } else {
                $stack->push($part);
            }

            $last = $part;
        }

        return $sum + $stack->pop();
    }

?>
    <div class="hasil">
        <?php echo wordsToNumber($text); ?>
    </div>
<?php
}

?>