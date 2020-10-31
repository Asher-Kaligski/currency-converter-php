<!DOCTYPE html>
<html lang="en">

<head>
    <title>‫‪Currency Converter</title>


    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

    <link rel="stylesheet" href="css/home.css" />
</head>

<body>
    <header class="container-fluid">
        <div class="logo"></div>
    </header>

    <div class="container-sm-fluid container main ">


        <div class="row py-3">



            <div class="container-fluid col-md-8">
                <div class="row">
                    <div class="col-6 form-group">
                        <label for="value">Change Value</label>
                        <input type="number" id="value" name="value" min="0.01" max="999999999" step="0.01"
                            class="form-control" placeholder="Change Value" />

                    </div>

                    <div class="col-6 form-group">
                        <label for="currencies" class="">Change To</label>
                        <select class="form-control" id="currencies" name="currencies"></select>
                    </div>

                    <div class="col-6 form-group">
                        <label for="base-currency" class="">Change From</label>
                        <select class="form-control" id="base-currency" name="base-currency"></select>
                    </div>
                    <div class="col-6 mt-1">
                        <label></label>
                        <button class="add-country btn btn-block btn-secondary pull-right add-currency">
                            Add &rarr;
                        </button>
                    </div>
                    <div class="col-12 d-md-none d-block mb-3">
                        <p class="text-center">List of money to change</p>
                        <ul class="list-group chosen-currencies text-center">

                        </ul>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-block btn-secondary pull-right show-change">
                            Show Change Value &rarr;
                        </button>
                    </div>
                    <div class="col-12 mt-5 d-flex justify-content-center align-items-center">
                        <table class='table table-striped'>
                            <thead class='thead-dark'>
                                <tr>
                                    <th scope='col'>Value</th>
                                    <th scope='col'>Change Rate</th>
                                    <th scope='col'>Change To</th>
                                    <th scope='col'>Change From</th>

                                </tr>

                            </thead>
                            <tbody class="table-body">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4 d-none d-md-block">
                <p class="text-center">List of money to change</p>
                <ul class="list-group chosen-currencies text-center">

                </ul>
            </div>
        </div>

    </div>

    <footer class="container-fluid bg-secondary d-flex justify-content-center align-items-center">
        <small class="text-center">© 2020. All Rights Reserved.</small>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script src="js/main.js"></script>
</body>

</html>