<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;700&display=swap" rel="stylesheet">
    <title>{{ $title }}</title>
    <style>
        .frequenceTable {
            border-collapse: collapse;
        }

        .frequenceTable tbody tr td {
            border: 1px solid #000;
        }

        .frequenceTable thead tr th {
            border: 1px solid #000;
        }

        .referenceDate{
            transform: rotate(-90deg);
            font-size: small;
        }

        .tableHeader{
            height: 50px;
        }

        .frequenceValue {
            text-align: center;
        }
    </style>
</head>
<body>
    @include('reports._header', ['header' => $header, 'title' => $title])
   <table class="frequenceTable">
    <thead>
        <tr class="tableHeader">
            <th>Aluno</th>
            @foreach($references as $reference)
                <th class="referenceDate">{{ $reference }}</th>
            @endforeach
            <th class="referenceDate">Total <br> Faltas</th>
        </tr>
    </thead>
    <tbody>
        @foreach  ($data as $name => $frequence)
            <tr>
                <td>
                    {{ $name }}
                </td>
                @foreach($frequence as $wasPresent)
                    <td class="frequenceValue">
                        @if($wasPresent) {{ '•' }}
                        @elseif($wasPresent == '-') {{ '-' }}
                        @else {{ 'F' }} @endif
                    </td>
                @endforeach
                <td class="frequenceValue">
                    {{ $totals[$name] }}
                </td>
            </tr>
        @endforeach
    </tbody>
   </table>
</body>
</html>
