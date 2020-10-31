<?php

if (isset($_GET['baseCurrency'])) {

    $baseCurrency = $_GET['baseCurrency'];

    $servername = "localhost:3306";
    $username = "root1";
    $password = "root1";
    $dbname = "currency_converter";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    $currentDay = date('Y-m-d');

    $sql = "SELECT * FROM currencies WHERE base_currency='$baseCurrency' AND date='$currentDay' ";
    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_array($result);
            echo json_encode($row);

            mysqli_free_result($result);
        } else {
            $req_url = "https://api.exchangeratesapi.io/latest?base=$baseCurrency";
            $response_json = file_get_contents($req_url);

            $response = json_decode($response_json);
            $rates = $response->rates;

            $encodedRates = json_encode($rates);

            $sql = "INSERT INTO currencies (date, base_currency, rates)
            VALUES ('$currentDay', '$baseCurrency', '$encodedRates')";

            if (mysqli_query($conn, $sql)) {
                $sql = "SELECT * FROM currencies WHERE base_currency='$baseCurrency' AND date='$currentDay' ";
                if ($result = mysqli_query($conn, $sql)) {
                    if (mysqli_num_rows($result) > 0) {

                        $row = mysqli_fetch_array($result);
                        echo json_encode($row);
                        mysqli_free_result($result);
                    } else {
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                    }
                }
            }

        }
        $sql = "DELETE FROM currencies WHERE date < NOW() - INTERVAL 2 DAY";

        mysqli_query($conn, $sql);

        $conn->close();
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        $conn->close();
    }

} else {
    $variable = 'something went wrong';
    echo json_encode(array("error" => $variable));

}

?>