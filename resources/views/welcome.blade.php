<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teste Gomide</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

</head>

<body class="bg-secondary">
    <center>
        <div class="card col-md-7 mt-3">
            <div class="card-header">
                <form action="{{ route('notas') }}" method="get" class="col-md-12"
                    style="height: 41px;display: flex;flex-direction: row;">
                    @csrf
                    <div class="form-group d-flex justify-content-between align-items-center">
                        <div class="flex-grow-1">
                            <label class="text-left font-weight-bold">Selecione o Mês:</label>
                        </div>
                        <div class="flex-grow-1 d-flex ms-2">
                            <form action="/" method="GET">
                                <input type="month" class="form-control" name="month"
                                    value="{{ session('month') }}">
                            </form>
                            <button style="display: flex;justify-content: center;align-items: center;"
                                class="btn btn-primary ms-2" type="submit">Trocar</button>
                        </div>
                  </div>
                </form>
            </div>

            <div class="card-body">
                <div class="card-header row">
                    <div class="col-md-5">
                        <label class="d-flex mb-1">Digite a pesquisa: </label>
                        <input type="text" id="search" name="search" class="form-control"
                            placeholder="Procurar...">
                    </div>
                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="mb-2 nav-link nfeEnt active" id="nfeEnt-tab" data-toggle="tab" href="#nfeEnt"
                            role="tab" aria-controls="nfeEnt" aria-selected="true"><i class="fa fa-address-card"
                                aria-hidden="true"></i>Notas </a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="nfeEnt" role="tabpanel" aria-labelledby="nfeEnt-tab">
                        <table id="tableEnt" style="width:100%" class="col-md-12 table-striped">
                            <thead>
                                @if ($notas)
                                    <tr>
                                        <th>Emitente</th>
                                        <th>Série</th>
                                        <th>UF</th>
                                        <th>Nº</th>
                                        <th>Valor</th>
                                        <th>Emissão</th>
                                        <th>Mês/Ano</th>
                                    </tr>
                                @else
                                    <td>Nenhum documento encontrado</td>
                                @endif
                            </thead>
                            <tbody class="allData">
                                @foreach ($notas as $nfe)
                                    <tr>
                                        <td> {{ $nfe->emitente }}</td>
                                        <td>{{ $nfe->serie ?? '1' }}</td>
                                        <td>{{ $nfe->UF }}</td>
                                        <td>{{ $nfe->n }}</td>
                                        <td><b>{{ $nfe->valor }}</b></td>
                                        <td>{{ $nfe->emissao }}</td>
                                        <td>{{ $nfe->mes_ano }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tbody id="Content" class="searchData"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </center>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
        $('#search').on('keyup', function() {
            $value = $(this).val();

            if ($value) {
                $('.allData').hide();
                $('.searchData').show();
            } else {
                $('.allData').show();
                $('.searchData').hide();
            }

            $.ajax({
                type: 'get',
                url: '{{ URL::to('search') }}',
                data: {
                    'search': $value
                },

                success: function(data) {
                    console.log(data);
                    $('#Content').html(data);
                }
            });
        })
    </script>
</body>
</html>
